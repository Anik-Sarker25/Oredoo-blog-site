<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $posts = Blog::latest()->take(3)->get();
        $categories = Category::all();
        $popular_posts = Blog::orderby('visitor_count', 'desc')->paginate(4);
        $recent_posts = Blog::orderBy('id','desc')->take(4)->get();
        return view('frontend.index.index', compact('posts', 'categories', 'popular_posts', 'recent_posts'));
    }
}
