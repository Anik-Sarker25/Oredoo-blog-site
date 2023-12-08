<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchBlogController extends Controller
{

    public function search(Request $request) {
        // $posts = Blog::all();
        // return view('frontend.blogs.index', compact('posts'));
        $search_value = $request->search_item;
        $posts = Blog::where('title','like', "%$search_value%")->orWhere('description','like', "%$search_value%")->get();
        return view('frontend.blogs.index', compact('posts'));
    }
}
