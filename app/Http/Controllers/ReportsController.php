<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    // Index Desks Reports
    public function desksIndex()
    {
        $data['users'] = User::where('desk_id', '<>', '')->get();
        return view('reports.desks.index', $data);
    }

    // Index Doctors Reports
    public function doctorsIndex()
    {
        $data['users'] = User::where('room_id', '<>', '')->get();
        return view('reports.doctors.index', $data);
    }
}
