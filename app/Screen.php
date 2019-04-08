<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
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

    // Floor Relation
    public function floor(){
        return $this->belongsTo('App\Floor');
    }
}
