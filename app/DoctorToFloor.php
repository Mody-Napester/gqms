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
    protected $fillable = ['doctor_id','floor_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
