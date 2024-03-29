<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'floor_id', 'area_id', 'screen_type_id', 'ip', 'printer_id', 'enable_print','name_ar', 'name_en', 'status', 'created_by', 'updated_by'];

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
     *  Delete existing resource
     */
    public static function remove($resource)
    {
        return self::where('id', $resource)->delete();
    }

    /**
     *  Get a specific resource
     */
    public static function getBy($by, $resource)
    {
        return self::where($by, $resource)->first();
    }

    /**
     *  Relationship with users
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');

    }

    /**
     *  Relationship with users
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');

    }

    // Floor Relation
    public function floor(){
        return $this->belongsTo('App\Floor');
    }

    // Area Relation
    public function area(){
        return $this->belongsTo('App\Area');
    }

    // Floors Relation
    public function floors(){
        return $this->belongsToMany('App\Floor', 'floor_kiosk', 'kiosk_id', 'floor_id');
    }

    // Rooms Relation
    public function rooms(){
        return $this->belongsToMany('App\Room', 'screen_room');
    }

    // Desks Relation
    public function desks(){
        return $this->belongsToMany('App\Desk', 'screen_desk');
    }

    // Printer Relation
    public function printer(){
        return $this->belongsTo('App\Printer');
    }

}
