<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLoginHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'login_ip', 'login_data', 'login_date_time', 'logout_date_time'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    // Store login history
    public static function store($user = null){
        if (is_null($user)){
            if (auth()->check()){
                $user = auth()->user();
            }else{
                return false;
            }
        }

        $browser = (function_exists('get_browser')) ? json_encode(get_browser(null, true)) : '';

        if (User::find($user->id)){
            $result = self::create([
                'user_id' => $user->id,
                'login_ip' => getenv_get_client_ip(),
                'login_data' => $browser,
            ]);

            return $result;
        }else{
            return false;
        }

//        if (User::find($user->id)){
//            $result = self::create([
//                'user_id' => $user->id,
//                'login_ip' => getenv_get_client_ip(),
//                'login_data' => $browser,
//            ]);
//
//            return $result;
//        }else{
//            return false;
//        }

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
}
