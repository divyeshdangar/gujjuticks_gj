<?php

namespace App\Http\Controllers\Dashboard;


use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $dataList = Blog::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.blog.index', ['dataList' => $dataList]);
    }

    public function view(Request $request, $id)
    {
        $dataDetail = Blog::find($id);
        if($dataDetail) {
            return view('dashboard.blog.view', ['dataDetail' => $dataDetail]);
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
        $dataDetail = Blog::find($id);
        if($dataDetail) {
            return view('dashboard.blog.edit', ['dataDetail' => $dataDetail]);
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
        $dataDetail = Blog::find($id);
        if($dataDetail) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'slug' => ['required','unique:blogs,slug,'.$id, 'min:5','max:255','regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'description' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect('dashboard/blog/edit/'.$id)->withErrors($validator)->withInput();
            }    
            $dataToInsert = $validator->validated();
            $dataDetail->title = $dataToInsert['title'];
            $dataDetail->description = $dataToInsert['description'];
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
        $dataList = Blog::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.blog.index', ['dataList' => $dataList]);
    }
}
