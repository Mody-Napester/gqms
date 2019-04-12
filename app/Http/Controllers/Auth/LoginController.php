<?php

namespace App\Http\Controllers\Auth;

use App\Desk;
use App\Http\Controllers\Controller;
use App\User;
use App\UserLoginHistory;
use http\Env\Request;
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

    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
//        dd($request->all(), $user->id);
        // Check if ip exists in desks
        $desk = Desk::getBy('ip', $request->login_ip);
        if ($desk){
            User::edit([
                'desk_id' => $desk->id,
                'login_ip' => $desk->ip
            ], $user->id);
        }
        UserLoginHistory::addLoginHistory();
    }
}
