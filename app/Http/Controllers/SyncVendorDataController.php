<?php

namespace App\Http\Controllers;

use App\DoctorSchedule;
use App\Reservation;
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
    public function syncAndTestConnection(){
        if (config('vars.syncData') == true){
            if (DB::connection('oracle')->getDatabaseName()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // Get all clinics
    public function getClientClinics()
    {
        if ($this->syncAndTestConnection() == false){
            return false;
        }

        DB::connection('oracle')->table('VW_CLINICS')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_Update');
            $q->orWhere('queue_system_integ_flag', 'HIS_UPDATE');
        })->orderBy('clinic_id')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                $array = [
                    'source_clinic_id' => $val->clinic_id,
                    'name_ar' => $val->clinic_name_ar,
                    'name_en' => $val->clinic_name_en
                ];
                if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {
                    Clinic::store($array);
                    DB::connection('oracle')->table('VW_CLINICS')->where('clinic_id', $val->clinic_id)
                        ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);
                } else {
                    $clinic = Clinic::getBy('source_clinic_id', $val->clinic_id);
                    if ($clinic) {
                        Clinic::editBySourceClinicId($array, $val->clinic_id);
                    } else {
                        Clinic::store($array);
                    }
                }
            }
        });

        return 'done';
    }

    // Get all specialities
    public function getClientSpecialities()
    {
        if ($this->syncAndTestConnection() == false){
            return false;
        }

        DB::connection('oracle')->table('vw_specialities')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_Update');
            $q->orWhere('queue_system_integ_flag', 'HIS_UPDATE');
        })->orderBy('speciality_id')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                $array = [
                    'source_speciality_id' => $val->speciality_id,
                    'name_ar' => $val->speciality_name_ar,
                    'name_en' => $val->speciality_name_en
                ];
                if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {
                    Speciality::store($array);
                    DB::connection('oracle')->table('vw_specialities')->where('speciality_id', $val->speciality_id)
                        ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);
                } else {
                    $speciality = Speciality::getBy('source_speciality_id', $val->speciality_id);
                    if ($speciality) {
                        Speciality::editBySourceSpecialityId($array, $val->speciality_id);
                    } else {
                        Speciality::store($array);
                    }
                }
            }
        });

        return 'done';
    }

    // Get all doctors
    public function getClientDoctors()
    {
        if ($this->syncAndTestConnection() == false){
            return false;
        }

        DB::connection('oracle')->table('vw_doctor_table')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_Update');
            $q->orWhere('queue_system_integ_flag', 'HIS_UPDATE');
        })->orderBy('emp_id')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {
                if ($val->emp_name_en) {
                    if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {
                        $user = User::create([
                            'email' => ' ',
                            'name' => $val->emp_name_en,
                            'password' => bcrypt(config('vars.default_password')),
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

                        // Add Role Relation
                        $user->roles()->attach(config('vars.roles.doctor'));

                        DB::connection('oracle')->table('vw_doctor_table')->where('emp_id', $val->emp_id)
                            ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);
                    } else {
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

        return 'done';
    }

    // Get all patients
    public function getClientPatients()
    {
        if ($this->syncAndTestConnection() == false){
            return false;
        }

        DB::connection('oracle')
            ->table('VW_PATIENTS')
            ->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_Update');
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
                } else {
                    $patient = Patient::getBy('source_patient_id', $val->patientid);
                    if ($patient) {
                        Patient::editBySourcePatientId($array, $val->patientid);
                    } else {
                        Patient::store($array);
                    }
                }
            }
        });

        return 'done';
    }

    // Get all reservation
    public function getClientReservations()
    {
        if ($this->syncAndTestConnection() == false){
            return false;
        }

        $today = date('Y-m-d');

        DB::connection('oracle')
            ->table('VW_RESERVATIONS')
            ->whereRaw("reservation_date_time >= date '$today'")
            ->where(function ($q) {
                $q->whereNull('queue_system_integ_flag');
                $q->orWhere('queue_system_integ_flag', '');
                $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
                $q->orWhere('queue_system_integ_flag', 'HIS_Update');
                $q->orWhere('queue_system_integ_flag', 'HIS_UPDATE');
            })->orderBy('ser')->chunk(100, function ($data) {
                foreach ($data as $key => $val) {

                    $array = [
                        'clinic_id' => $val->clinic_id,
                        'doctor_id' => $val->doctor_id,
                        'source_reservation_serial' => $val->ser,
                        'source_queue_number' => $val->que_sys_ser,
                        'patientid' => $val->patientid,
                        'reservation_date_time' => $val->reservation_date_time,
                        'speciality_id' => $val->speciality_id,
                        'servstatus' => $val->servstatus,
                        'cashier_flag' => $val->cashier_flag,
                    ];

                    if($array){
                        if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {
                            Reservation::store($array);
                            DB::connection('oracle')->table('VW_RESERVATIONS')->where('ser', $val->ser)
                                ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);

                        } else {

                            $reservation = Reservation::getBy('source_reservation_serial', $val->ser);

                            if ($reservation) {
                                Reservation::editBySourceReservationSer($array, $val->ser);
                            } else {
                                Reservation::store($array);
                            }

                        }
                    }

                }
            });

        return 'done';
    }

    // Get all schedules
    public function getClientSchedules()
    {
        if ($this->syncAndTestConnection() == false){
            return false;
        }

        DB::connection('oracle')->table('VW_DOCTOR_SCHEDULE')->where(function ($q) {
            $q->whereNull('queue_system_integ_flag');
            $q->orWhere('queue_system_integ_flag', '');
            $q->orWhere('queue_system_integ_flag', 'HIS_NEW');
            $q->orWhere('queue_system_integ_flag', 'HIS_Update');
        })->orderBy('serial')->chunk(100, function ($data) {
            foreach ($data as $key => $val) {

                $array = [
                    'daynumber' => $val->daynumber,
                    'dayname_ar' => $val->dayname_ar,
                    'dayname_en' => $val->dayname_en,
                    'shift_flag' => $val->shift_flag,
                    'starttime' => $val->starttime,
                    'endtime' => $val->endtime,
                    'duration_by_hour' => $val->duration_by_hour,
                    'time_slot_by_minute' => $val->time_slot_by_minute,
                    'startdate' => $val->startdate,
                    'enddate' => $val->enddate,
                    'week_frequency_flag' => $val->week_frequency_flag,
                    'emp_id' => $val->emp_id,
                    'place_id1' => $val->place_id1,
                    'hosp_id' => $val->hosp_id,
                    'serial' => $val->serial,
                    'queue_system_integ_flag' => $val->queue_system_integ_flag,
                ];

                if (empty($val->queue_system_integ_flag) || $val->queue_system_integ_flag == 'HIS_NEW') {

                    DoctorSchedule::store($array);

                    DB::connection('oracle')->table('VW_DOCTOR_SCHEDULE')->where('serial', $val->serial)
                        ->update(['queue_system_integ_flag' => 'PROCEED_PMS']);

                }
                else {

                    $schedule = DoctorSchedule::getBy('serial', $val->serial);

                    if ($schedule) {
                        DoctorSchedule::editBySourceScheduleSerial($array, $val->serial);
                    } else {
                        DoctorSchedule::store($array);
                    }

                }
            }
        });

        return 'done';
    }
}
