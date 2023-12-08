<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }

    public function name_update(Request $request,$id)
    {

        $request->validate([
            'name' => 'required',
        ]);
        User::find($id)->update([
            'name' => $request->name,
            'created_at' => now(),
        ]);
        return back()->with('update_success', 'Name has been updated successfully');
    }
    public function email_update(Request $request,$id)
    {

        $request->validate([
            'email' => 'required|email:rfc,dns',
        ]);
        User::find($id)->update([
            'email' => $request->email,
            'created_at' => now(),
        ]);
        return back()->with('update_success', 'Email has been updated successfully');
    }
    public function image_update(Request $request,$id)
    {

        $request->validate([
            'image' => 'required|image',
        ]);

        if($request->hasFile('image')) {
            // $profile = User::where('id',$id)->first();
            // unlink(public_path('uploads/profile/'.$profile->image));
            $new_name = auth()->id().'-'.auth()->user()->name.'.'.$request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->resize(200, 200);
            $img->save(base_path('public/uploads/profile/'.$new_name), 60);

            User::find($id)->update([
                'image' => $new_name,
                'created_at' => now(),
            ]);
            return back()->with('update_success', 'Image has been updated successfully');
        }


    }
    public function password_update(Request $request,$id) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ]);

        if(Hash::check($request->current_password,auth()->user()->password)) {
            if($request->current_password != $request->password) {
                User::find($id)->update([
                    'password' => $request->password,
                    'created_at' => now(),
                ]);
                return back()->with('update_success', 'Password has been updated successfully');
            }else {
                return back()->with('update_error', 'Please enter a different password');
            } 

        }else {
            return back()->with('update_error', 'Incorrect password! please enter the right password');
        }

    }


}
