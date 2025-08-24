<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\PostItem;
use App\Models\PostSet;
use App\Models\InstagramPostSet;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Traits\InstagramTrait;

class PostSetController extends Controller
{
    use InstagramTrait;

    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Postset", "route" => ""],
            ],
            "title" => "Postset List"
        ];
        $prompt = "Give me 9 point for 'history of Jamnagar' with 1 title, keywords, meta description, to create 10 Instagram post, also give me 1 proper caption with rich hashtags and whatever best for Instagram. Make sure you give it all in proper associative array in below format. Do not include emojis in title or posts, but you can in caption.
        [
        'title' => '',
        'posts' => [
            [
            'title' => '',
            'description' => ''
            ]
        ],
        'caption' => '',
        'keywords' => '',
        'meta_description' => ''
        ]";

        $dataList = PostSet::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.postset.index', ['dataList' => $dataList, 'prompt' => $prompt, 'metaData' => $metaData]);
    }

    public function edit(Request $request, $id)
    {
        $dataDetail = PostSet::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Postset", "route" => "dashboard.postset"],
                    ["title" => "Edit", "route" => ""],
                ],
                "title" => $dataDetail->title
            ];
            $imageData = Image::orderBy('title')->where('title', 'LIKE', '%post set%')->get();
            return view('dashboard.postset.edit', ['imageData' => $imageData, 'dataDetail' => $dataDetail, 'metaData' => $metaData]);
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
        $dataDetail = PostSet::find($id);
        if ($dataDetail || $id == 0) {
            if ($id == 0) {
                $dataDetail = new PostSet();
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'slug' => ['required', 'unique:post_sets,slug,' . $id, 'min:5', 'max:255', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'meta_description' => 'required',
                'caption' => 'required',
                'keywords' => 'sometimes',
                'image_id' => 'required',
            ]);

            if ($validator->fails()) {
                if ($id == 0) {
                    return redirect('dashboard/postset/create')->withErrors($validator)->withInput();
                } else {
                    return redirect('dashboard/postset/edit/' . $id)->withErrors($validator)->withInput();
                }
            }

            $dataToInsert = $validator->validated();
            $dataDetail->slug = $dataToInsert['slug'];

            if ($request->file('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $fileName = $dataToInsert['slug'] . time() . '-front.' . $extension;
                $file->move(public_path(config('paths.images.postset')), $fileName);
                $dataDetail->image = $fileName;
            } elseif (empty($dataDetail->image)) {
                $dataDetail->image = 'default.png';
            }

            $dataDetail->title = $dataToInsert['title'];
            $dataDetail->caption = $dataToInsert['caption'];
            $dataDetail->meta_description = $dataToInsert['meta_description'];
            $dataDetail->image_id = $dataToInsert['image_id'];
            $dataDetail->keywords = $dataToInsert['keywords'];
            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.postset')->with($message);
        } else {
            return redirect()->route('dashboard.postset');
        }
    }

    public function list(Request $request, $id)
    {
        $dataDetail = PostSet::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Postset", "route" => "dashboard.postset"],
                    ["title" => "List", "route" => ""],
                ],
                "title" => $dataDetail->title
            ];
            $imageData = Image::orderBy('title')->where('title', 'LIKE', '%post set%')->get();
            $itemData = PostItem::orderBy('order')->where('post_set_id', $dataDetail->id)->get();
            return view('dashboard.postset.list', ['itemData' => $itemData, 'imageData' => $imageData, 'dataDetail' => $dataDetail, 'metaData' => $metaData]);
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

    public function publish(Request $request, $id)
    {
        $dataDetail = PostSet::find($id);
        if ($dataDetail) {
            $imageLinkArray = [];
            $imageLinkArray[] = route('pages.image.postmain', ['slug' => $dataDetail->slug . '.jpg']);

            $itemData = PostItem::orderBy('order')
                ->where('post_set_id', $dataDetail->id)
                ->orderBy('order')
                ->limit(9)
                ->pluck('slug')
                ->toArray();

            if (!empty($itemData)) {
                foreach ($itemData as $key => $value) {
                    $imageLinkArray[] = route('pages.image.postset', ['slug' => $value . '.jpg']);
                }
            }
            unset($itemData);

            $profile = Profile::where('user_id', Auth::id())
                ->where('type', 'insta')
                ->first();

            if ($profile) {
                dd(['profile' => $profile, 'imageLinkArray' => $imageLinkArray, 'dataDetail' => $dataDetail]);

                $result = $this->publishCarouselPost($profile, $imageLinkArray, $dataDetail->caption, 5, 3);

                $success  = $result['success'];
                $errorMsg = $success ? null : ($result['message'] ?? 'Unknown error');
                $igPostId = $success ? ($result['id'] ?? null) : null;

                InstagramPostSet::create([
                    'user_id'           => Auth::id(),
                    'post_set_id'       => $dataDetail->id,
                    'instagram_post_id' => $igPostId,
                    'status'            => $success ? 'posted' : 'failed',
                    'error_message'     => $errorMsg,
                ]);

                $message = [
                    "message" => [
                        "type" => $success ? 'success' : 'error',
                        "title" => $success ? __('dashboard.great') : __('dashboard.bad'),
                        "description" => $success ? __('dashboard.instagram_post_published') : $errorMsg
                    ]
                ];
            } else {
                $message = [
                    "message" => [
                        "type" => "error",
                        "title" => __('dashboard.bad'),
                        "description" => __('dashboard.no_record_found') . '(' . __('dashboard.profile') . ')'
                    ]
                ];
            }

            return redirect()->route('dashboard.postset')->with($message);
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
}
