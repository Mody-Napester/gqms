<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorToFloor extends Model
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
     *  Delete existing resource
     */
    public static function remove($resource)
    {
        return self::where('id', $resource)->delete();
    }

    /**
     *  Get a specific resource
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
        return $this->belongsTo('App\Clinic', 'source_clinic_id');
    }

    // Reservations Relation
    public function reservations(){
        return $this->hasMany('App\Reservation');
    }
}
