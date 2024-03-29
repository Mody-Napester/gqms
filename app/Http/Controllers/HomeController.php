<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            return redirect(route('dashboard.index'));
        } else {
            return redirect(route('login'));
        }
    }

    /**
     * Reset Queues.
     */
    public function resetQueues()
    {
        DB::update('update reservations set desk_queue_id = null');

        DB::delete('delete from room_queues');
        DB::delete('delete from room_queue_statuses');

        DB::delete('delete from desk_queues');
        DB::delete('delete from desk_queue_statuses');

        return back()->with('message', [
            'text' => 'Successfully Reset',
            'type' => 'success'
        ]);
    }
}
