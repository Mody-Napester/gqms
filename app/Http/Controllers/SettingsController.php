<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check permissions
        if (!User::hasAuthority('index.desks')){
            return redirect('/');
        }

        $data['any'] = '';
        
        return view('settings.index', $data);
    }

}
