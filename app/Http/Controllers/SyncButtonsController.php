<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Doctor;
use App\Patient;
use App\Reservation;
use App\Speciality;
use Illuminate\Http\Request;

class SyncButtonsController extends Controller
{
    public $sync;

    public function __construct()
    {
        $this->sync = new SyncVendorDataController();
    }

    public function syncClient($what)
    {
        if ($what == 'clinics'){
            return $this->syncClinics();
        }
        elseif ($what == 'doctors'){
            return $this->syncDoctors();
        }
        elseif ($what == 'patients'){
            return $this->syncPatients();
        }
        elseif ($what == 'reservations'){
            return $this->syncReservations();
        }
        elseif ($what == 'specialities'){
            return $this->syncSpecialities();
        }
    }

    // Sync clinics
    public function syncClinics()
    {
        if ($this->sync->getClientClinics()){
            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Sync Done ..',
            ];

            $data['clinics'] = Clinic::all();
            $data['view'] = view('clinics._list', $data)->render();
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Connection or sync failed',
            ];
        }

        // Return
        return response()->json($data);
    }

    // Sync Doctors
    public function syncDoctors()
    {
        if ($this->sync->getClientDoctors()){
            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Sync Done ..',
            ];

            $data['doctors'] = Doctor::all();
            $data['view'] = view('doctors._list', $data)->render();
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Connection or sync failed',
            ];
        }

        // Return
        return response()->json($data);
    }

    // Sync Patients
    public function syncPatients()
    {
        if ($this->sync->getClientPatients()){
            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Sync Done ..',
            ];

            $data['patients'] = Patient::all();
            $data['view'] = view('patients._list', $data)->render();
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Connection or sync failed',
            ];
        }

        // Return
        return response()->json($data);
    }

    // Sync Patients
    public function syncReservations()
    {
        if ($this->sync->getClientReservations()){
            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Sync Done ..',
            ];

            $data['reservations'] = Reservation::all();
            $data['view'] = view('reservations._list', $data)->render();
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Connection or sync failed',
            ];
        }

        // Return
        return response()->json($data);
    }

    // Sync Specialities
    public function syncSpecialities()
    {
        if ($this->sync->getClientSpecialities()){
            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Sync Done ..',
            ];

            $data['specialities'] = Speciality::all();
            $data['view'] = view('specialities._list', $data)->render();
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Connection or sync failed',
            ];
        }

        // Return
        return response()->json($data);
    }

}
