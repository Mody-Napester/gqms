<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['desk_queue_id', 'doctor_id', 'clinic_id', 'source_reservation_serial', 'source_queue_number', 'patientid',  'reservation_date_time', 'speciality_id'
        , 'servstatus','cashier_flag','created_at', 'updated_at'];

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
     *  Update existing resource editBySourceReservationSer
     */
    public static function editBySourceReservationSer($inputs, $resource)
    {
        return self::where('ser', $resource)->update($inputs);
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
        return $this->belongsTo('App\Doctor');
    }

    // Clinic Relation
    public function clinic(){
        return $this->belongsTo('App\Clinic');
    }

    // Room Queue Relation
    public function roomQueue(){
        return $this->belongsTo('App\RoomQueue', 'source_queue_number','queue_number');
    }

    // Patient Relation
    public function patient(){
        return $this->belongsTo('App\Patient', 'patientid', 'source_patient_id');
    }
}
