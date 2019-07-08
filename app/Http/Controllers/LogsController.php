<?php

namespace App\Http\Controllers;

use App\Log;
use App\User;
use App\UserLoginHistory;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    /**
     * Display a listing of the logs user logins.
     */
    public function index_logs_user_logins()
    {
        // Check permissions
        if (!User::hasAuthority('index.logs_user_logins')){
            return redirect('/');
        }
        $data['logs'] = UserLoginHistory::getAll();
        return view('logs.user_logins.index', $data);
    }

    /**
     * Display a listing of the logs user actions.
     */
    public function index_logs_user_actions()
    {
        // Check permissions
        if (!User::hasAuthority('index.logs_user_actions')){
            return redirect('/');
        }
        $data['logs'] = Log::getAll();
        return view('logs.user_actions.index', $data);
    }
}
