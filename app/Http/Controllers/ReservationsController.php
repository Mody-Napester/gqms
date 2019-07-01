<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\User;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check permissions
//        if (!User::hasAuthority('index.reservations')){
//            return redirect('/');
//        }

        $data['reservations'] = Reservation::where('doctor_id',856)
            ->where('reservation_date_time', 'like', '2019%')
            ->get();
        return view('reservations.index', $data);
    }
}
