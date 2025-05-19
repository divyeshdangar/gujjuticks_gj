<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategories;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('user:id,name,profile')->with('category:id,title,slug')->select('id', 'user_id', 'category_id', 'title', 'image', 'description', 'meta_description', 'created_at')->limit(2)->get();

        if (!$blogs) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        foreach ($blogs as $key => $blog) {
            $blog->image = $blog->image();
        }

        return response()->json($blogs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $blog = Blog::with('user:id,name,profile')->with('category:id,title,slug')->select('id', 'user_id', 'category_id', 'title', 'image', 'description', 'meta_description', 'created_at')->where('slug', $slug)->first();

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }
        $blog->image = $blog->image();

        return response()->json($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
