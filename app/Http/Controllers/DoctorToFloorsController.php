<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\DoctorToFloor;
use App\Floor;
use App\User;
use Illuminate\Http\Request;

class DoctorToFloorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check permissions
//        if (!User::hasAuthority('index.doctors')){
//            return redirect('/');
//        }

        $data['doctors'] = Doctor::getAll();
        $data['floors'] = Floor::getAll();
        return view('doctor_to_floors.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
