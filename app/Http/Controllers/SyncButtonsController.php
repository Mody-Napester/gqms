<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SyncButtonsController extends Controller
{
    public $sync;

    public function __construct()
    {
        $this->sync = new SyncVendorDataController();
    }

    // Sync clinics
    public function syncClinics()
    {
        if ($this->sync->getClientClinics()){
            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Sync Done ..',
            ];
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
