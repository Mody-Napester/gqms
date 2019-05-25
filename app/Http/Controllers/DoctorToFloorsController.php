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
     * @param  string  $floor_uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $floor_uuid)
    {
        // Code
        if($request->has('doctors')){
            if (count($request->doctors) > 0){
                $floor = Floor::getBy('uuid', $floor_uuid);

                if ($floor){

                    $floor->doctors()->detach();

                    foreach ($request->doctors as $doctor_uuid) {
                        $floor->doctors()->attach(Doctor::getBy('uuid', $doctor_uuid)->id);
                    }

                    $data['message'] = [
                        'msg_status' => 1,
                        'text' => 'Updated!',
                    ];
                }else{
                    $data['message'] = [
                        'msg_status' => 0,
                        'text' => 'Floor not exists!',
                    ];
                }

            }else{
                $data['message'] = [
                    'msg_status' => 0,
                    'text' => 'Doctors are empty!',
                ];
            }
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Please select doctors first!',
            ];
        }

        // Return
        return response()->json($data);
    }

    /**
     * Get Doctor Floor.
     */
    public function getDoctorFloor($doctor_uuid)
    {
        // Code
        $doctor = Doctor::getBy('uuid', $doctor_uuid);

        if ($doctor){
            $floor = DoctorToFloor::where('doctor_id', $doctor->id)->first();
            if ($floor){

                $data['floor'] = Floor::getBy('id', $floor->floor_id)->uuid;

                $data['message'] = [
                    'msg_status' => 1,
                    'text' => 'Done!',
                ];
            }else{
                $data['message'] = [
                    'msg_status' => 0,
                    'text' => 'Doctor not exists in any floor!',
                ];
            }
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Doctor not found in our database!',
            ];
        }

        // Return
        return response()->json($data);
    }
}
