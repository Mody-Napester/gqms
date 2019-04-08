<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
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

    // Desks Relation
    public function desks(){
        return $this->hasMany('App\Desk');
    }

    // Desks Relation
    public function screens(){
        return $this->hasMany('App\Screen');
    }
}
