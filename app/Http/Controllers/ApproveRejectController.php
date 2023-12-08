<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApproveRejectController extends Controller
{
    public function approve($id) {
       $users = User::where('id', $id)->first();
       if($users->approve_status == false) {
            User::find($id)->update([
                'approve_status' => true,
                'updated_at' => now(),
            ]);
            return back();
       }else {
            User::find($id)->update([
                'approve_status' => false,
                'updated_at' => now(),
            ]);
            return back();
       }
    }
    public function reject($id) {
       $users = User::where('id', $id)->first();
       if($users->approve_status == false) {
            User::find($id)->delete();
            return back();
       }
       if($users->approve_status == true) {
            User::find($id)->delete();
            return back();
       }
    }
    public function block_status($id) {
       $users = User::where('id', $id)->first();
       if($users->block_status == 'blocked') {
            User::find($id)->update([
                'block_status' => 'unblocked',
                'updated_at' => now(),
            ]);
            return back();
       }
       if($users->block_status == 'unblocked') {
        User::find($id)->update([
            'block_status' => 'blocked',
            'updated_at' => now(),
        ]);
            return back();
       }
    }
}
