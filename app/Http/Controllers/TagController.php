<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::paginate(2);
        $trashed = Tag::onlyTrashed()->get();
        return view('dashboard.tag.index', compact('tags', 'trashed'));
    }
    public function insert(Request $request) {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        Tag::insert([
            'name' => $request->name
        ]);

        return back()->with('insert_success', 'Tag has been added successfully');
    }
    public function delete($id) {
        Tag::find($id)->delete();
        return back()->with('delete_success', 'Tag has been deleted successfully');
    }
    public function status($id) {
        $tag = Tag::where('id',$id)->first();
        if($tag->status == 'active') {
            Tag::find($id)->update([
                'status' => 'deactive'
            ]);
            return back()->with('update_success', 'Tag status has been updated successfully - active to deactive');
        }else {
            Tag::find($id)->update([
                'status' => 'active'
            ]);
            return back()->with('update_success', 'Tag status has been updated successfully - deactive to active');
        }
    }
    public function restore($id) {
        Tag::withTrashed()
        ->where('id', $id)
        ->restore();
        return back()->with('update_success', 'Tag number '.$id.' has been restored successfully');
    }
    public function deletepermanent($id) {
        Tag::withTrashed()
        ->where('id', $id)
        ->forceDelete();
        return back()->with('delete_success', 'Tag has been permanently deleted');
    }

}
