<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\User;
use Illuminate\Http\Request;

class DoctorsController extends Controller
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

        $data['doctors'] = Doctor::groupBy('source_doctor_id')->get();
        return view('doctors.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateNickName(Request $request, $doctor_uuid)
    {
        $doctor = Doctor::getBy('uuid', $doctor_uuid);

        $editedDoctor = $doctor->update([
            'nickname' => $request->nickname
        ]);

        // Return
        if ($editedDoctor){
            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Updated successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Error! .. please try again.',
            ];
        }

        return response()->json($data);
    }
}
