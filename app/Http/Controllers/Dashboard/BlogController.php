<?php

namespace App\Http\Controllers\Dashboard;


use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [];
        $dataList = Blog::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.blog.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function view(Request $request, $id)
    {
        $dataDetail = Blog::find($id);
        if($dataDetail) {
            return view('dashboard.blog.view', ['dataDetail' => $dataDetail, 'metaData' => []]);
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
                ["title" => "Board", "Blogs" => "dashboard.blog"],
                ["title" => "Create", "route" => ""]
            ],
            "title" => "Create Board"
        ];
        return view('dashboard.blog.create', ['metaData' => $metaData]);
    }
    
    public function edit(Request $request, $id)
    {
        $dataDetail = Blog::find($id);
        if($dataDetail) {
            $locationData = Location::where('parent_id', 2)->orderBy('name')->get();
            return view('dashboard.blog.edit', ['dataDetail' => $dataDetail, 'locationData' => $locationData, 'metaData' => []]);
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

        // dd($request->croppedImage);

        $dataDetail = Blog::find($id);
        if($dataDetail) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'slug' => ['required','unique:blogs,slug,'.$id, 'min:5','max:255','regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'meta_description' => 'required',
                'description' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect('dashboard/blog/edit/'.$id)->withErrors($validator)->withInput();
            }  
            
            
            $dataToInsert = $validator->validated();

            if ($request->croppedImage != null) {
                $croped_image = $request->croppedImage;
                list($type, $croped_image) = explode(';', $croped_image);
                list(, $croped_image)      = explode(',', $croped_image);
                $croped_image = base64_decode($croped_image);
                $image_name = "123456789.png"; //time() . rand(10000000, 999999999) . '.png';
                file_put_contents("./images/blog/" . $image_name, $croped_image);
                $dataDetail->image = $image_name;
            }

            $dataDetail->title = $dataToInsert['title'];
            $dataDetail->description = $dataToInsert['description'];
            $dataDetail->meta_description = $dataToInsert['meta_description'];            
            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.blog')->with($message);
        } else {
            return redirect()->route('dashboard.blog');
        }
    }


    public function delete(Request $request, $id)
    {
        //
    }
}
