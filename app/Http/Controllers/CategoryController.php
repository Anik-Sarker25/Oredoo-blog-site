<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() {
        $catagories = Category::paginate(2);
        return view('dashboard.category.index', compact('catagories'));
    }

    public function insert(Request $request) {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'required|image',
        ]);

        $new_name = auth()->id().'-'.date('h-i-s').'.'.$request->file('image')->getClientOriginalExtension();
        $img = Image::make($request->file('image'))->resize(200, 200);
        $img->save(base_path('public/uploads/category/'.$new_name), 60);

        if($request->hasFile('image')) {

            if($request->slug) {
                Category::insert([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug),
                    'image' => $new_name,
                    'created_at' => now()
                ]);
                return back()->with('insert_success', 'Category has been inserted successfully');
            }else {
                Category::insert([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'image' => $new_name,
                    'created_at' => now()
                ]);
                return back()->with("insert_success", "Category insert function set your slug as your title because you didn't set the slug, and inserted successfully");
            }
        }



    }
    public function delete($id) {
        Category::find($id)->delete();
        return back()->with('delete_success', 'Category has been deleted successfully');
    }


    public function edit(Request $request,$id) {
        $request->validate([
            'title' => 'required|min:3',
        ]);

        if($request->hasFile('image')) {

            $category = Category::where('id',$id)->first();
            unlink(public_path('uploads/category/'.$category->image));
            $new_name = $id.'-'.date('h-i-s').'.'.$request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->resize(200, 200);
            $img->save(base_path('public/uploads/category/'.$new_name), 60);
            if($request->slug) {
                Category::find($id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug),
                    'image' => $new_name,
                    'created_at' => now()
                ]);
                return back()->with('insert_success', 'Category has been updated successfully');
            }else {
                Category::find($id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'image' => $new_name,
                    'created_at' => now()
                ]);
                return back()->with("insert_success", "Category updated function set your slug as your title because you didn't set the slug, and updated successfully");
            }
        }else {
            if($request->slug) {
                Category::find($id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug),
                    'created_at' => now()
                ]);
                return back()->with('insert_success', 'Category has been updated successfully');
            }else {
                Category::find($id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'created_at' => now()
                ]);
                return back()->with("insert_success", "Category updated function set your slug as your title because you didn't set the slug, and updated successfully");
            }
        }
    }

    public function status($id) {
        $category = Category::where('id',$id)->first();
        if($category->status == 'active') {
            Category::find($id)->update([
                'status' => 'deactive',
            ]);
            return back()->with('update_success', 'Category status has been updated successfully - active to deactive');
        }else {
            Category::find($id)->update([
                'status' => 'active',
            ]);
            return back()->with('update_success', 'Category status has been updated successfully - deactive to active');
        }
    }
}
