<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;

class RoleManagement extends Controller
{
    public function user() {
        $all_users = User::all();
        $specific_users = User::where('role', 'editor')->orwhere('role', 'author')->orwhere('role', 'user')->get();
        return view('dashboard.role.index', compact('all_users', 'specific_users'));
    }

    public function add_user() {
        return view('dashboard.role.add');
    }

    public function insert(Request $request) {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ]);

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'created_at' => now(),
        ]);
        return redirect()->route('user')->with('insert_success', "Mr. $request->name has been added successfully as a $request->role in this site");
    }


    public function edit(Request $request, $id) {
        User::find($id)->update([
            'role' => $request->role,
            'updated_at' => now(),
        ]);

        return back()->with('update_success', "Mr $request->usernam has been promoted to $request->role successfully");
    }

    public function delete($id) {
        User::find($id)->delete();
        return back()->with('delete_success', 'User has been deleted successfully');
    }



}
