<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['daynumber, dayname_ar, dayname_en, shift_flag, starttime, endtime, duration_by_hour, time_slot_by_minute, startdate, enddate, week_frequency_flag, emp_id, place_id1, hosp_id, serial, queue_system_integ_flag', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) \Webpatser\Uuid\Uuid::generate(config('vars.uuid_ver'));
        });
    }

    /**
     *  Create new resource
     */
    public static function store($inputs)
    {
        return self::create($inputs);
    }

    /**
     *  Update existing resource
     */
    public static function edit($inputs, $resource)
    {
        return self::where('id', $resource)->update($inputs);
    }

    /**
     *  Update existing resource editBySourceScheduleSerial
     */
    public static function editBySourceScheduleSerial($inputs, $resource)
    {
        return self::where('serial', $resource)->update($inputs);
    }

    /**
     *  Delete existing resource
     */
    public static function remove($resource)
    {
        return self::where('id', $resource)->delete();
    }

    /**
     *  Get all resources
     */
    public static function getAll($status = 1)
    {
        return self::where('status', $status)->get();
    }

    /**
     *  Get a specific resource
     */
    public static function getBy($by, $resource)
    {
        return self::where($by, $resource)->first();
    }

    // Doctor Relation
    public function doctor(){
        return $this->belongsTo('App\Doctor', 'doctor_id', 'source_doctor_id');
    }

}
