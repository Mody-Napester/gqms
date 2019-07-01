<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomAuthController extends Controller
{
    // Logout Users
    public function logoutUsers(){
        $users = User::where('login_ip', '<>', '')->get();
        foreach ($users as $user){
            // Update user
            User::edit([
                'room_id' => null,
                'desk_id' => null,
                'login_ip' => null,
                'available' => 0,
            ], $user->id);
        }

        return back()->with('message', [
            'text' => 'Successfully Logged out ('. count($users) .') users',
            'type' => 'success'
        ]);
    }
}
