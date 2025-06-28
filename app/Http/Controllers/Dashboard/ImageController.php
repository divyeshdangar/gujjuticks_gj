<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\ImagesData;
use App\Models\Uploads;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{

    public function index(Request $request)
    {
        $dataList = Image::orderBy('id', 'DESC');
        if (!Auth::user()->is_admin()) {
            $dataList->where('user_id', Auth::id());
        }
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.image.index', ['dataList' => $dataList, 'metaData' => []]);
    }

    public function create(Request $request)
    {
        $dataToInsert = new Image();
        $dataToInsert->title = 'New Data';
        $dataToInsert->slug = rand(100000, 999999);
        $dataToInsert->type = 'color';
        $dataToInsert->height = '512';
        $dataToInsert->width = '512';
        $dataToInsert->options = '{}';
        $dataToInsert->bg_color = '#000000';
        $dataToInsert->save();

        if($dataToInsert->id > 0) {
            return redirect()->route('dashboard.image.edit', ['id' => $dataToInsert->id]);
        } else {
            return redirect()->route('dashboard.image');
        }
    }

    public function data(Request $request, $id)
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {
            $dataUploads = Uploads::where("image_id", $id)->get();
            $dataList = ImagesData::orderBy('list_order', 'ASC')->where('image_id', $dataDetail->id)->get();

            $metaData = [
                "breadCrumb" => [
                    ["title" => "Image", "route" => "dashboard.image"],
                    ["title" => "Detail", "route" => "dashboard.image.edit.post", "params" => [$id]],
                    ["title" => "Data List", "route" => ""]
                ],
                "title" => "Image Data List"
            ];

            return view('dashboard.image.data', ['dataDetail' => $dataDetail, 'metaData' => $metaData, 'dataUploads' => $dataUploads, 'dataList' => $dataList]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard')->with($message);
        }
    }

    public function edit(Request $request, $id)
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Image", "route" => "dashboard.image"],
                    ["title" => "Edit", "route" => ""],
                ],
                "title" => $dataDetail->title
            ];
            return view('dashboard.image.edit', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard')->with($message);
        }
    }

    public function store(Request $request, $id): RedirectResponse
    {
        $dataDetail = Image::find($id);
        if ($dataDetail || $id == 0) {
            if ($id == 0) {
                $dataDetail = new Image();
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'slug' => ['required', 'unique:images,slug,' . $id, 'min:5', 'max:255', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'meta_description' => 'required',
                'type' => 'required|in:color,image,random_color',
                'bg_color' => 'required',
                'colors' => 'sometimes',
                'description' => 'required',                
                'height' => 'required|numeric|min:100|max:5000',
                'width' => 'required|numeric|min:100|max:5000',
                'image_title' => 'required',
                'image_alt' => 'required',
                'keywords' => 'required',
            ]);

            if ($validator->fails()) {
                if ($id > 0) {
                    return redirect('dashboard/image/edit/' . $id)->withErrors($validator)->withInput();
                } else {
                    return redirect('dashboard/image/create')->withErrors($validator)->withInput();
                }
            }

            $dataToInsert = $validator->validated();

            $dataDetail->title = $dataToInsert['title'];
            $dataDetail->description = $dataToInsert['description'];
            $dataDetail->slug = $dataToInsert['slug'];
            $dataDetail->meta_description = $dataToInsert['meta_description'];            
            $dataDetail->height = $dataToInsert['height'];
            $dataDetail->width = $dataToInsert['width'];
            $dataDetail->type = $dataToInsert['type'];
            $dataDetail->bg_color = $dataToInsert['bg_color'];
            $dataDetail->colors = $dataToInsert['colors'];
            $dataDetail->image_title = $dataToInsert['image_title'];
            $dataDetail->image_alt = $dataToInsert['image_alt'];
            $dataDetail->keywords = $dataToInsert['keywords'];
            if ($id == 0) {
                $dataDetail->user_id = Auth::id();
            }

            if ($request->file('image')) {
                $temp = explode(".", $request->file('image')->getClientOriginalName());
                $fileName = time() . '-' . rand(0, time()) . '.' . end($temp);
                $request->image->storeAs(config('paths.images.dynamic'), $fileName, 'public');
                $dataDetail->image = $fileName;
            }

            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.image')->with($message);
        } else {
            return redirect()->route('dashboard.image');
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {
            $validator = Validator::make($request->all(), [
                'options' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('dashboard/image/view/' . $id)->withErrors($validator)->withInput();
            }
            $dataToInsert = $validator->validated();
            $dataDetail->options = $dataToInsert['options'];
            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.image.data', ['id' => $id])->with($message);
        } else {
            return redirect()->route('dashboard.image');
        }
    }

    public function delete(Request $request, $id)
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {            
            $dataDetail->data(true)->delete();
            $dataDetail->delete();
            return redirect()->route('dashboard.image');
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.image')->with($message);
        }
    }

    public function deleteData(Request $request, $id, $image_id)
    {
        $dataDetail = ImagesData::where('id', $id)->where('image_id', $image_id)->first();
        if ($dataDetail) {
            $dataDetail->delete();
            return redirect()->route('dashboard.image.data', ['id' => $image_id]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.image')->with($message);
        }
    }

    public function editData(Request $request, $id, $image_id)
    {
        $dataDetail = Image::find($image_id);
        if ($dataDetail) {
            $dataListDetail = ImagesData::find($id);
            if ($dataListDetail) {
                $metaData = [
                    "breadCrumb" => [
                        ["title" => "Image", "route" => "dashboard.image"],
                        ["title" => "Detail", "route" => "dashboard.image.edit.post", "params" => [$image_id]],
                        ["title" => "Data List", "route" => "dashboard.image.data", "params" => ['id' => $image_id]],
                        ["title" => "Data List Detail", "route" => ""]
                    ],
                    "title" => $dataDetail->title
                ];

                try {
                    $fontData = File::files(public_path(config('paths.fonts')));
                    $fontData = array_map(function ($file) {
                        return $file->getFilename(); // Only the name, not full path
                    }, $fontData);
                } catch (\Throwable $th) {
                    $fontData = [];
                }
                return view('dashboard.image.editData', ['fontData' => $fontData, 'dataDetail' => $dataDetail, 'metaData' => $metaData, 'dataListDetail' => $dataListDetail]);
            }
        }
        $message = [
            "message" => [
                "type" => "error",
                "title" => __('dashboard.bad'),
                "description" => __('dashboard.no_record_found')
            ]
        ];
        return redirect()->route('dashboard')->with($message);
    }

    public function createData(Request $request, $id)
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {            
            $dataToInsert = new ImagesData();
            $dataToInsert->image_id = $id;
            $dataToInsert->is_editable = '0';
            $dataToInsert->random_identity = rand(100000, 9999990);
            $dataToInsert->save();

            if($dataToInsert->id > 0) {
                return redirect()->route('dashboard.image.data.edit', ['id' => $dataToInsert->id, 'image_id' => $id]);
            } else {
                return redirect()->route('dashboard.image.data', ['id' => $id]);
            }
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.image')->with($message);
        }
    }

    public function storeData(Request $request, $id, $image_id): RedirectResponse
    {
        $dataDetail = Image::find($image_id);
        if ($dataDetail) {
            $dataListDetail = ImagesData::where('id', $id)->where('image_id', $image_id)->first();
            if ($dataListDetail) {
                $validator = Validator::make($request->all(), [
                    'text' => 'sometimes',
                    'random_identity' => ['required', 'min:3', 'max:20', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                    'type' => 'required|in:text,image,paragraph,random_text',
                    'is_editable' => 'sometimes',
                    'font' => 'sometimes',
                    'font_size' => 'sometimes|numeric',
                    'text_color' => 'sometimes',
                    'text_align' => 'sometimes',
                    'left' => 'sometimes|numeric',
                    'text_align_v' => 'sometimes',
                    'top' => 'sometimes|numeric',
                    'angle' => 'sometimes|numeric',
                    'list_order' => 'required|numeric|min:0|max:1024',
                    'opacity' => 'sometimes|numeric|min:0|max:127',
                    'height' => 'sometimes|numeric|min:0|max:5000',
                    'width' => 'sometimes|numeric|min:0|max:5000',
                    'form_title' => 'sometimes',
                    'form_description' => 'sometimes',
                ]);

                if ($validator->fails()) {
                    return redirect()->route('dashboard.image.data.edit', ['id' => $id, 'image_id' => $image_id])->withErrors($validator)->withInput();
                }

                $dataToInsert = $validator->validated();

                $dataListDetail->text = $dataToInsert['text'];
                $dataListDetail->random_identity = $dataToInsert['random_identity'];
                $dataListDetail->type = $dataToInsert['type'];
                $dataListDetail->is_editable = $dataToInsert['is_editable'];
                $dataListDetail->font = $dataToInsert['font'];
                $dataListDetail->font_size = $dataToInsert['font_size'];
                $dataListDetail->text_color = $dataToInsert['text_color'];
                $dataListDetail->text_align = $dataToInsert['text_align'];
                $dataListDetail->left = $dataToInsert['left'];
                $dataListDetail->text_align_v = $dataToInsert['text_align_v'];
                $dataListDetail->top = $dataToInsert['top'];
                $dataListDetail->angle = $dataToInsert['angle'];
                $dataListDetail->list_order = $dataToInsert['list_order'];
                $dataListDetail->opacity = $dataToInsert['opacity'];
                $dataListDetail->height = $dataToInsert['height'];
                $dataListDetail->width = $dataToInsert['width'];
                $dataListDetail->form_title = $dataToInsert['form_title'];
                $dataListDetail->form_description = $dataToInsert['form_description'];

                if ($request->file('image')) {
                    $temp = explode(".", $request->file('image')->getClientOriginalName());
                    $fileName = time() . '-' . rand(0, time()) . '.' . end($temp);
                    $request->image->storeAs(config('paths.images.dynamic_data'), $fileName, 'public');
                    $dataListDetail->image = $fileName;
                }

                $dataListDetail->save();

                $message = [
                    "message" => [
                        "type" => "success",
                        "title" => __('dashboard.great'),
                        "description" => __('dashboard.details_submitted')
                    ]
                ];
                return redirect()->route('dashboard.image.data', ['id' => $image_id])->with($message);
            }
        }
        return redirect()->route('dashboard.image');
    }

    public function copy(Request $request, $id)
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {
            $newPost = $dataDetail->replicate();
            $newPost->created_at = Carbon::now();
            $newPost->save();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.image')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.image')->with($message);
        }
    }

    public function upload(Request $request, $id): RedirectResponse
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {
            $validator = Validator::make($request->all(), [
                'image' => 'sometimes|file|mimes:jpg,jpeg,png|max:4048',
            ]);

            if ($validator->fails()) {
                return redirect('dashboard/image/view/' . $id)->withErrors($validator)->withInput();
            }
            if ($request->file('image')) {
                $dataDetail = new Uploads();
                $dataDetail->user_id = Auth::id();
                $dataDetail->image_id = $id;
                $dataDetail->original_name = $request->file('image')->getClientOriginalName();
                $temp = explode(".", $dataDetail->original_name);
                $fileName = time() . '-' . rand(0, time()) . '.' . end($temp);
                $request->image->storeAs('images/dynamic', $fileName, 'public');
                $dataDetail->image = $fileName;
                $dataDetail->save();
            }

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.image.data', ["id" => $id])->with($message);
        } else {
            return redirect()->route('dashboard.image');
        }
    }
}
