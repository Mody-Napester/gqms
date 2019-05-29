<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','source_doctor_id','source_speciality_id','name_en','name_ar','gander','workstatus', 'created_at', 'updated_at'];

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

    public static function editBySourceDoctorId($inputs, $resource)
    {
        return self::where('source_doctor_id', $resource)->update($inputs);
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
    public static function getAll()
    {
        return self::all();
    }

    /**
     *  Get a specific resource
     */
    public static function getBy($by, $resource)
    {
        return self::where($by, $resource)->first();
    }

    // User Relation
    public function user(){
        return $this->belongsTo('App\User');
    }

    // Clinic Relation
    public function clinic(){
        return $this->belongsTo('App\Clinic', 'source_clinic_id', 'source_doctor_id');
    }

    // Speciality Relation
    public function speciality(){
        return $this->belongsTo('App\Speciality', 'source_speciality_id', 'source_speciality_id');
    }

    // Reservations Relation
    public function reservations(){
        return $this->hasMany('App\Reservation');
    }

    // Doctor To Floor Relation
    public function inFloor(){
        return $this->belongsTo('App\DoctorToFloor');
    }
}
