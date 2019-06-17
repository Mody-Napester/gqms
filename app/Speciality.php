<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['source_speciality_id', 'name_en', 'name_ar', 'created_at', 'updated_at'];

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


    public static function editBySourceSpecialityId($inputs, $resource)
    {
        return self::where('source_speciality_id', $resource)->update($inputs);
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

    // Area Relation
    public function area(){
        return $this->hasOne('App\Area');
    }

    // Areas Relation
    public function areas(){
        return $this->belongsToMany('App\Area', 'area_speciality');
    }

}
