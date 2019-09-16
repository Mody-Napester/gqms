<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeskQueueStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'desk_queue_id', 'queue_status_id'];

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
     *  Get Desk Queues
     */
    public static function getDeskQueues($user_id, $queue_status_id, $all = null, $date = null)
    {
        $count = self::where('user_id', $user_id)->where('queue_status_id', $queue_status_id);

        if($all == null){
            if($date == null){
                $count = $count->where('created_at', 'like', "%".date('Y-m-d')."%");
            }else{
                $count = $count->where('created_at', 'like', "%".date($date)."%");
            }
        }

        $count = $count->count();

        return $count;
    }

    /**
     *  Get Count Desk Queues
     */
    public static function getCountDeskQueue($queue_status_id, $all = null)
    {
        $count = self::where('queue_status_id', $queue_status_id);

        if (is_null($all)){
            $count = $count->where('created_at', 'like', "%".date('Y-m-d')."%")->count();
        }else{
            $count = $count->count();
        }

        return $count;
    }
}
