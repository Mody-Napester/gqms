<?php

namespace App\Http\Controllers;

use App\DoctorSchedule;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check permissions
//        if (!User::hasAuthority('index.schedules')){
//            return redirect('/');
//        }

        $data['schedules'] = DoctorSchedule::all();
        return view('schedules.index', $data);
    }
}
