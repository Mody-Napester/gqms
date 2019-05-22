<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use app\VW_SPECIALITIES;
use App\Clinic;
use App\Speciality;
use App\Patient;
use App\Doctor;
use App\User;
use App\Enums\UserTypes;
use DB;

class SyncVendorDataController extends Controller
{
    // Get all clinics
    public function getClientClinics()
    {
        DB::connection('oracle')->table('VW_CLINICS')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_UPDATE');
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
                } else if ($val->queue_system_integ_flag == 'HIS_UPDATE') {
                    $clinic = Clinic::getBy('source_clinic_id', $val->clinic_id);
                    if ($clinic) {
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
        return true;
    }

    // Get all specialities
    public function getClientSpecialities()
    {
        DB::connection('oracle')->table('vw_specialities')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_UPDATE');
        })->orderBy('speciality_id')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {
                    Speciality::store([
                        'source_speciality_id' => $val->speciality_id,
                        'name_ar' => $val->speciality_name_ar,
                        'name_en' => $val->speciality_name_en
                    ]);
                    DB::connection('oracle')->table('vw_specialities')->where('speciality_id', $val->speciality_id)
                        ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);
                } else if ($val->queue_system_integ_flag == 'HIS_UPDATE') {
                    $speciality = Speciality::getBy('source_speciality_id', $val->speciality_id);
                    if ($speciality) {
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
        return true;
    }

    // Get all doctors
    public function getClientDoctors()
    {
        DB::connection('oracle')->table('vw_doctor_table')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_UPDATE');
        })->orderBy('emp_id')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                if ($val->emp_name_en) {
                    if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {
                        $user = User::create([
                            'email' => ' ',
                            'name' => $val->emp_name_en,
                            'password' => Hash::make(config('vars.defualt_password')),
                            'type' => UserTypes::$typesReverse['Doctor'],
                            'status' => $val->workstatus == 1 ? 1 : 0,
                            'created_by' => 0,
                            'updated_by' => 0,
                        ]);
                        User::edit([
                            'email' => strtolower(explode(' ', $val->emp_name_en)[0]) . ($user->id + 5)
                        ], $user->id);
                        Doctor::store([
                            'user_id' => $user->id,
                            'source_doctor_id' => $val->emp_id,
                            'source_speciality_id' => $val->special_spec_id,
                            'name_ar' => $val->emp_name_ar,
                            'name_en' => $val->emp_name_en,
                            'gander' => $val->emp_gendur,
                            'workstatus' => $val->workstatus == 1 ? 1 : 0
                        ]);
                        DB::connection('oracle')->table('vw_doctor_table')->where('emp_id', $val->emp_id)
                            ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);
                    } else if ($val->queue_system_integ_flag == 'HIS_UPDATE') {
                        $doctor = Doctor::getBy('source_doctor_id', $val->emp_id);
                        if ($doctor) {
                            Doctor::editBySourceDoctorId([
                                'source_doctor_id' => $val->emp_id,
                                'source_speciality_id' => $val->special_spec_id,
                                'name_ar' => $val->emp_name_ar,
                                'name_en' => $val->emp_name_en,
                                'gander' => $val->emp_gendur,
                                'workstatus' => $val->workstatus == 1 ? 1 : 0
                            ], $val->emp_id);
                            User::edit([
                                'name' => $val->emp_name_en,
                                'status' => $val->workstatus == 1 ? 1 : 0
                            ], $doctor->id);
                        } else {
                            $user = User::create([
                                'email' => ' ',
                                'name' => $val->emp_name_en,
                                'password' => Hash::make(config('vars.defualt_password')),
                                'type' => UserTypes::$typesReverse['Doctor'],
                                'status' => $val->workstatus == 1 ? 1 : 0,
                                'created_by' => 0,
                                'updated_by' => 0,
                            ]);
                            User::edit([
                                'email' => strtolower(explode(' ', $val->emp_name_en)[0]) . ($user->id + 5)
                            ], $user->id);
                            Doctor::store([
                                'user_id' => $user->id,
                                'source_doctor_id' => $val->emp_id,
                                'source_speciality_id' => $val->special_spec_id,
                                'name_ar' => $val->emp_name_ar,
                                'name_en' => $val->emp_name_en,
                                'gander' => $val->emp_gendur,
                                'workstatus' => $val->workstatus == 1 ? 1 : 0
                            ]);
                        }
                    }
                }
            }
        });
        return true;
    }

    // Get all patients
    public function getClientPatients()
    {
        DB::connection('oracle')->table('VW_PATIENTS')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_UPDATE');
        })->orderBy('patientid')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                if ($val->contact_mobile_1) {
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
                } else if ($val->queue_system_integ_flag == 'HIS_UPDATE') {
                    $patient = Patient::getBy('source_patient_id', $val->patientid);
                    if ($patient) {
                        Patient::editBySourcePatientId($array, $val->patientid);
                    } else {
                        Patient::store($array);
                    }
                }
            }
        });
        return true;
    }

    // Get all reservation
    public function getClientReservations()
    {
        $r = DB::connection('oracle')->table('VW_RESERVATIONS')->where('SER', 3747)->first();

        dd($r);

        DB::connection('oracle')->table('VW_RESERVATIONS')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_UPDATE');
        })->orderBy('patientid')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                if ($val->contact_mobile_1) {
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
                } else if ($val->queue_system_integ_flag == 'HIS_UPDATE') {
                    $patient = Patient::getBy('source_patient_id', $val->patientid);
                    if ($patient) {
                        Patient::editBySourcePatientId($array, $val->patientid);
                    } else {
                        Patient::store($array);
                    }
                }
            }
        });
        return true;
    }
}
