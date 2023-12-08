<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index() {
        return view('frontend.contact.contact');
    }
    public function send(Request $request) {

        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|min:3|max:255',
            'message' => 'required|string|min:3',
        ]);
        if (auth()->id()) {
            Contact::insert([
                'auth_id' => auth()->id(),
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at' => now(),
            ]);
            Mail::to("anikhasen25@gmail.com")->send(new ContactMail($request->except('_token')));
            return back()->with('insert_success', 'Your message was sent successfully as a authorized user');
        }else {
            Contact::insert([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at' => now(),
            ]);
            // Mail::to($request->email)->send(new ContactMail($request->except('_token')));

            Mail::to("anikhasen25@gmail.com")->send(new ContactMail($request->except('_token')));
            return back()->with('insert_success', 'Your message was sent successfully as a guest');
        }

    }
}
