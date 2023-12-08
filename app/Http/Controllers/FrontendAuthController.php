<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontendAuthController extends Controller
{
    public function index() {
        return view('frontend.auth.signup');
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
            'role' => 'author',
            'approve_status' => false,
            'created_at' => now(),
        ]);
        $email = $request->email;
        $password = $request->password;
        return redirect()->route('signin.view')->with('insert_success', "Your registration is successful")->with('email', "$email")->with('password', "$password");
    }
    public function signin() {
        return view('frontend.auth.login');
    }
    public function access(Request $request) {
        $request->validate([
            '*' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'approve_status' => true])) {

            return redirect()->route('home');
            // $sep_user = User::where('email', $request->email)->orwhere('password', $request->password)->first();
            // $sep_user->sendEmailVerificationNotification();

        }elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'approve_status' => false])) {
            return back()->with('approve_false', "Your registration is pending for admin approval");
        }else {
            return back()->with('login_failed', "Incorrect password or email address !");
        }
    }
}
