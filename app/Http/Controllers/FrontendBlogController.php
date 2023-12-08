<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendBlogController extends Controller
{
    public function index($id) {
        $posts = Blog::where('category_id', $id)->paginate(4);
        $categories = Category::where('id', $id)->first();
        return view('frontend.category.category_post', compact('posts', 'categories'));
    }
    public function single_post($id) {
        $posts = Blog::with('ManyWithTags')->where('id', $id)->first();
        if($posts) {
            Blog::find($id)->update([
                'visitor_count' => $posts->visitor_count +1,
            ]);
        }
        return view('frontend.single_post.category_single_post', compact('posts'));
    }
    public function tag_post($id) {
        $tags_name = Tag::where('id', $id)->first();
        $tags = Tag::with('ManyWithBlogs')->where('id', $id)->get();
        $posts = $tags[0]->ManyWithBlogs()->paginate(4);
        return view('frontend.tag_post.tag_post', compact('tags_name', 'posts'));
    }
}
