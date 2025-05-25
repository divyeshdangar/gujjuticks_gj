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
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default 10 per page

        $blogs = Blog::with('user:id,name,profile')->with('category:id,title,slug')->select('id', 'slug', 'user_id', 'category_id', 'title', 'image', 'description', 'meta_description', 'keywords', 'created_at')->paginate($perPage);

        if (!$blogs) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        foreach ($blogs as $key => $blog) {
            $blog->image = $blog->image();
            if ($blog->user) {
                $blog->user->profile = $blog->user->profile();
            }
        }

        return response()->json([
            'data' => $blogs->items(),
            'total' => $blogs->total(),
            'current_page' => $blogs->currentPage(),
            'next_page' => $blogs->hasMorePages() ? $blogs->currentPage() + 1 : null,
            'last_page' => $blogs->lastPage(),
            'per_page' => $blogs->perPage(),
        ]);
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
        $blog = Blog::with('user:id,name,profile')->with('category:id,title,slug')->select('id', 'user_id', 'category_id', 'title', 'image', 'description', 'meta_description', 'keywords', 'created_at')->where('slug', $slug)->first();

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }
        $blog->image = $blog->image();
        $blog->keywords = explode(',', $blog->keywords);
        if ($blog->user) {
            $blog->user->profile = $blog->user->profile();
        }

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
