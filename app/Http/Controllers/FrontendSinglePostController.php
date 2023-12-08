<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendSinglePostController extends Controller
{
    public function index($id) {
        $posts = Blog::with('ManyWithTags')->where('id', $id)->first();
        if($posts) {
            Blog::find($id)->update([
                'visitor_count' => $posts->visitor_count +1,
            ]);
        }
        $comments = Comment::with('reletionwithreply')->where('post_id', $id)->whereNull('parent_id')->get();
        return view('frontend.single_post.single_post', compact('posts', 'comments'));
    }
    public function tag_post($id) {
        $tags_name = Tag::where('id', $id)->first();
        $tags = Tag::with('ManyWithBlogs')->where('id', $id)->get();
        $posts = $tags[0]->ManyWithBlogs()->paginate(4);
        return view('frontend.tag_post.single_page_tag_post', compact('tags_name', 'posts'));
    }
}
