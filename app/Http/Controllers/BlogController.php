<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function index() {
        $categorie = Category::all();
        $tags = Tag::all();
        $blogs = Blog::with('ManyWithTags')->get();
        $specificblogs = Blog::with('ManyWithTags')->where('user_id', auth()->user()->id)->get();
        return view('dashboard.blog.index', compact('categorie','tags','blogs','specificblogs'));
    }
    public function create() {
        $categorie = Category::all();
        $tags = Tag::all();
        return view('dashboard.blog.create',[
            'categorie' => $categorie,
            'tags' => $tags,
        ]);
    }
    public function insert(Request $request) {
        $request->validate([
            'title' => 'required|min:3',
            'category_id' => 'required',
            'date' => 'required|date|after:start_date',
            'image' => 'required|image',
            'description' => 'required',
        ]);

        if($request->hasFile('image')) {
            $new_name = auth()->id().'-'.date('h-i-s').'.'.$request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->resize(1368, 718);
            $img->save(base_path('public/uploads/blog/'.$new_name), 60);

            $blog = Blog::create([
                'title' => $request->title,
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'image' => $new_name,
                'date' => $request->date,
                'created_at' => now(),
            ]);
            $blog->ManyWithTags()->attach($request->tag_id);
            $blog->save();
            return redirect()->route('blog')->with('insert_success', 'Post has been created successfully');
        }



    }


    // public function view() {
    //     $categorie = Category::all();
    //     $tags = Tag::all();
    //     return view('dashboard.blog.edit',[
    //         'categorie' => $categorie,
    //         'tags' => $tags,
    //     ]);
    // }



    public function update(Request $request,$id) {
        // $blog = Blog::where('id',$id)->first();

        // return $blog;

        $request->validate([
            'title' => 'required|min:3',
        ]);

        if($request->hasFile('image')) {
            $blogImage = Blog::where('id',$id)->first();
            unlink(public_path('uploads/blog/'.$blogImage->image));
            $new_name = $id.'-'.date('h-i-s').'.'.$request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->resize(1368, 718);
            $img->save(base_path('public/uploads/blog/'.$new_name), 60);

            // $blog = Blog::find($id)->create([
            //     'title' => $request->title,
            //     'user_id' => auth()->user()->id,
            //     'category_id' => $request->category_id,
            //     'description' => $request->description,
            //     'image' => $new_name,
            //     'date' => $request->date,
            //     'updated_at' => now(),
            // ]);
            $blog = Blog::find($id);
            $blog->title = $request->title;
            $blog->user_id =  auth()->user()->id;
            $blog->category_id = $request->category_id;
            $blog->description = $request->description;
            $blog->image = $new_name;
            $blog->date = $request->date;
            $blog->updated_at = $request->updated_at;
            $blog->ManyWithTags()->sync($request->tag_id);
            $blog->save();
            return redirect()->route('blog')->with('update_success', 'Post has been updated successfully');
        }else {
            $blog = Blog::find($id);
            $blog->title = $request->title;
            $blog->user_id =  auth()->user()->id;
            $blog->category_id = $request->category_id;
            $blog->description = $request->description;
            // $blog->image = $new_name;
            $blog->date = $request->date;
            $blog->updated_at = $request->updated_at;
            $blog->ManyWithTags()->sync($request->tag_id);
            $blog->save();
            return redirect()->route('blog')->with('update_success', 'Post has been updated successfully');
        }
    }


    public function delete($id) {
        Blog::find($id)->delete();

        return back()->with('delete_success', 'Post has been deleted successfully');
    }
}
