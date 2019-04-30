<?php

namespace App\Http\Controllers\Auth;

use App\Desk;
use App\Events\DeskStatus;
use App\Events\RoomStatus;
use App\Room;
use App\User;
use App\UserLoginHistory;
use http\Env\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    // After Login
    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        // Check if user and ip exists in desks or in rooms
        if($user->type == 1){ // Doctor
            $data['resource'] = Room::getBy('ip', $request->login_ip);
        }
        elseif($user->type == 2){ // Desk
            $data['resource'] = Desk::getBy('ip', $request->login_ip);
            dd($data['resource']);
        }

        // Update user
        if (isset($data['resource'])){
            // Update user
            User::edit([
                'room_id' => ($user->type == 1)? $data['resource']->id : null,
                'desk_id' => ($user->type == 2)? $data['resource']->id : null,
                'login_ip' => $data['resource']->ip,
                'available' => 1,
            ], $user->id);

            // Broadcast event
            if($user->type == 1){ // Doctor
                event(new RoomStatus($data['resource']->uuid, 1));
            }
            elseif($user->type == 2){ // Desk
                event(new DeskStatus($data['resource']->uuid, 1));
            }

        }

        // Add user login history
        UserLoginHistory::addLoginHistory();
    }

    // Custom Logout
    public function logout(\Illuminate\Http\Request $request) {

        if(auth()->user()->desk_id){
            // Broadcast event
            event(new DeskStatus(Desk::getBy('id', auth()->user()->desk_id)->uuid, 0));
    
            // Update user
            User::edit([
                'desk_id' => null,
                'login_ip' => null,
                'available' => 0,
            ], auth()->user()->id);
        }
        elseif(auth()->user()->room_id){
            // Broadcast event
            event(new RoomStatus(Room::getBy('id', auth()->user()->room_id)->uuid, 0));

            // Update user
            User::edit([
                'room_id' => null,
                'login_ip' => null,
                'available' => 0,
            ], auth()->user()->id);
        }

        auth()->logout();
        return redirect(route('login'));
    }
}
