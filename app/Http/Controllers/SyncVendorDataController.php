<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use app\VW_SPECIALITIES;
use DB;

class SyncVendorDataController extends Controller
{
    // Get all clinics
    public function getClientClinics(){
        // DB::connection('oracle')->table('VW_SPECIALITIES')->where('SPECIALITY_ID', '2')->update(['queue_system_integ_flag' => 'testhossam']);
        $all = DB::connection('oracle')->table('VW_SPECIALITIES')->where('SPECIALITY_ID', '2')->first();
        // QUEUE_SYSTEM_INTEG_FLAG = 'TEST' WHERE SPECIALITY_ID = 1
        return dd($all);
    }
    // Get all specialities
    public function getClientSpecialities(){}
    // Get all doctors
    public function getClientDoctors(){}
    // Get all patients
    public function getClientPatients(){}
    // Get all reservation
    public function getClientReservations(){}
}
