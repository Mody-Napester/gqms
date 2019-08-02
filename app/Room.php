<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['floor_id', 'ip','name_ar', 'name_en', 'status', 'created_by', 'updated_by'];

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
    public static function getAll($status = null) // 1 or 0
    {
        if (is_null($status)){
            $data = self::all();
        }else{
            $data = self::where('status', $status)->get();
        }

        return $data;
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

    /**
     *  Logged in users
     */
    public static function logegdInUsers($filed)
    {
        $loggedInUsers = User::where('room_id', '<>', '')->where('available', 1)->get();
        return $loggedInUsers->pluck($filed)->toArray();
    }

    // Floor Relation
    public function floor(){
        return $this->belongsTo('App\Floor');
    }

    // Screen Relation
    public function screens(){
        return $this->belongsToMany('App\Screen', 'screen_room');
    }

    // User Relation
    public function user(){
        return $this->hasOne('App\User');
    }
}
