<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendBlogPageController extends Controller
{
    public function index() {
        $posts = Blog::all();
        return view('frontend.blogs.index', compact('posts'));
    }
}
