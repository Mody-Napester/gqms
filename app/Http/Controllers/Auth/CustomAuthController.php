<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    // Logout user after close browser
    public function authCloseBrowserLogout(){
//        $user = User::getBy('id', auth()->user()->id);
//        auth()->logout();

        $userToLogout = User::find(auth()->user()->id);
        Auth::setUser($userToLogout);
        Auth::logout();

        return back();
    }
}
