<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Template", "route" => ""],
            ],
            "title" => "Template List"
        ];
        $dataList = Template::orderBy('id', 'DESC')->where('status', '1');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.template.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function view(Request $request, $id)
    {
        $dataDetail = Template::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Template", "route" => "dashboard.template"],
                    ["title" => "Detail", "route" => ""]
                ],
                "title" => "Template Detail"
            ];
            return view('dashboard.template.view', ['types' => $dataDetail->getTypes(), 'dataDetail' => $dataDetail, 'metaData' => $metaData]);
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

    public function create(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Template", "route" => "dashboard.template"],
                ["title" => "Create", "route" => ""]
            ],
            "title" => "Create Template"
        ];
        return view('dashboard.template.create', ['metaData' => $metaData]);
    }

    public function edit(Request $request, $id)
    {
        $dataDetail = Template::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Template", "route" => "dashboard.template"],
                    ["title" => "Edit", "route" => ""]
                ],
                "title" => "Edit Template"
            ];    
            return view('dashboard.template.edit', ['types' => $dataDetail->getTypes(), 'dataDetail' => $dataDetail, 'metaData' => $metaData]);
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

    public function form(Request $request, $id)
    {
        $dataDetail = Template::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Template", "route" => "dashboard.template"],
                    ["title" => "Form", "route" => ""]
                ],
                "title" => "Template Form"
            ];    
            return view('dashboard.template.form', ['types' => $dataDetail->getTypes(), 'dataDetail' => $dataDetail, 'metaData' => $metaData]);
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
        $dataDetail = Template::find($id);
        if ($dataDetail || $id == 0) {
            if ($id == 0) {
                $dataDetail = new Template();
                $dataDetail->user_id = Auth::id();
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'type' => 'required',
                'slug' => ['required', 'unique:Template,slug,' . $id, 'min:5', 'max:255', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'meta_description' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                if($id > 0) {
                    return redirect('dashboard/template/edit/' . $id)->withErrors($validator)->withInput();
                } else {
                    return redirect('dashboard/template/create')->withErrors($validator)->withInput();
                }
            }

            $dataToInsert = $validator->validated();

            if ($request->file('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // Get the original file extension
                $fileName = time() . '-' . rand(0, time()) . '.' . $extension; // Use the original extension
                $file->storeAs('images/template', $fileName, 'public');
                $dataDetail->image = $fileName;
            } else {
                dd($request);
            }

            $dataDetail->title = $dataToInsert['title'];
            $dataDetail->type = $dataToInsert['type'];
            $dataDetail->description = $dataToInsert['description'];
            $dataDetail->slug = $dataToInsert['slug'];
            $dataDetail->meta_description = $dataToInsert['meta_description'];
            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.template')->with($message);
        } else {
            return redirect()->route('dashboard.template');
        }
    }

    public function delete(Request $request, $id)
    {        
        $dataDetail = Template::find($id);
        if ($dataDetail) {
            $dataDetail->status = '0';
            $dataDetail->save();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.record_deleted')
                ]
            ];
            return redirect()->route('dashboard.template')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.template')->with($message);
        }
    }

}
