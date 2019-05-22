<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use app\VW_SPECIALITIES;
use App\Clinic;
use App\Speciality;
use App\Patient;
use DB;

class SyncVendorDataController extends Controller
{
    // Get all clinics
    public function getClientClinics()
    {
        //dd(DB::connection('oracle')->table('VW_CLINICS')->update(['queue_system_integ_flag' => 'PROCEED_PMS']));
        DB::connection('oracle')->table('VW_CLINICS')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_Update');
        })->orderBy('clinic_id')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {
                    Clinic::store([
                        'source_clinic_id' => $val->clinic_id,
                        'name_ar' => $val->clinic_name_ar,
                        'name_en' => $val->clinic_name_en
                    ]);
                    DB::connection('oracle')->table('VW_CLINICS')->where('clinic_id', $val->clinic_id)
                        ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);
                } else if($val->queue_system_integ_flag == 'HIS_Update') {
                    $clinic = Clinic::getBy('source_clinic_id', $val->clinic_id);
                    if($clinic) {
                        Clinic::editBySourceClinicId([
                            'source_clinic_id' => $val->clinic_id,
                            'name_ar' => $val->clinic_name_ar,
                            'name_en' => $val->clinic_name_en,
                        ], $val->clinic_id);
                    } else {
                        Clinic::store([
                            'source_clinic_id' => $val->clinic_id,
                            'name_ar' => $val->clinic_name_ar,
                            'name_en' => $val->clinic_name_en
                        ]);
                    }
                }
            }
        });
        return 'DONE';
    }
    // Get all specialities
    public function getClientSpecialities(){
        DB::connection('oracle')->table('vw_specialities')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_Update');
        })->orderBy('speciality_id')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {
                    Speciality::store([
                        'source_speciality_id' => $val->speciality_id,
                        'name_ar' => $val->speciality_name_ar ,
                        'name_en' => $val->speciality_name_en
                    ]);
                    DB::connection('oracle')->table('vw_specialities')->where('speciality_id', $val->speciality_id)
                        ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);
                } else if($val->queue_system_integ_flag == 'HIS_Update') {
                    $speciality = Speciality::getBy('source_speciality_id', $val->speciality_id);
                    if($speciality) {
                        Speciality::editBySourceSpecialityId([
                            'source_speciality_id' => $val->speciality_id,
                            'name_ar' => $val->speciality_name_ar,
                            'name_en' => $val->speciality_name_en,
                        ], $val->speciality_id);
                    } else {
                        Speciality::store([
                            'source_speciality_id' => $val->speciality_id,
                            'name_ar' => $val->speciality_name_ar,
                            'name_en' => $val->speciality_name_en
                        ]);
                    }
                }
            }
        });
        return 'DONE';
    }
    // Get all doctors
    public function getClientDoctors(){
        DB::connection('oracle')->table('vw_doctor_table')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_Update');
        })->orderBy('emp_id')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                dd($val);
                if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {
                    Speciality::store([
                        'source_speciality_id' => $val->speciality_id,
                        'name_ar' => $val->speciality_name_ar ,
                        'name_en' => $val->speciality_name_en
                    ]);
                    DB::connection('oracle')->table('vw_specialities')->where('speciality_id', $val->speciality_id)
                        ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);
                } else if($val->queue_system_integ_flag == 'HIS_Update') {
                    $speciality = Speciality::getBy('source_speciality_id', $val->speciality_id);
                    if($speciality) {
                        Speciality::editBySourceSpecialityId([
                            'source_speciality_id' => $val->speciality_id,
                            'name_ar' => $val->speciality_name_ar,
                            'name_en' => $val->speciality_name_en,
                        ], $val->speciality_id);
                    } else {
                        Speciality::store([
                            'source_speciality_id' => $val->speciality_id,
                            'name_ar' => $val->speciality_name_ar,
                            'name_en' => $val->speciality_name_en
                        ]);
                    }
                }
            }
        });
        return 'DONE';
    }
    // Get all patients
    public function getClientPatients(){
        DB::connection('oracle')->table('VW_PATIENTS')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_Update');
        })->orderBy('patientid')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                if($val->contact_mobile_1) {
                    $phone = $val->contact_mobile_1;
                } elseif ($val->contact_hometel_1) {
                    $phone = $val->contact_hometel_1;
                } else {
                    $phone = $val->contact_worktel_1;
                }
                $array = [
                    'source_patient_id' => $val->patientid,
                    'name_ar' => $val->completepatname,
                    'name_en' => $val->completepatname_en,
                    'phone' => $phone
                ];
                if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {
                    Patient::store($array);
                    DB::connection('oracle')->table('VW_PATIENTS')->where('patientid', $val->patientid)
                        ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);
                } else if($val->queue_system_integ_flag == 'HIS_Update') {
                    $patient = Patient::getBy('source_patient_id', $val->patientid);
                    if($patient) {
                        Patient::editBySourcePatientId($array, $val->patientid);
                    } else {
                        Patient::store($array);
                    }
                }
            }
            dd($data);
        });
        return 'DONE';
    }
    // Get all reservation
    public function getClientReservations(){}
}