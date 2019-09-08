<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomQueueStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'room_queue_id', 'queue_status_id'];

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
     *  Get Room Queues
     */
    public static function getRoomQueues($user_id, $queue_status_id, $all = null,$date = null)
    {
        $count = self::where('user_id', $user_id)->where('queue_status_id', $queue_status_id);

        if($all == null){
            if($date == null){
                $count = $count->where('created_at', 'like', "%".date('Y-m-d')."%");
            }else{
                $count = $count->where('created_at', 'like', "%".$date."%");
            }
        }

        $count = $count->count();

        return $count;
    }

    /**
     *  Get Count Room Queues
     */
    public static function getCountRoomQueue($queue_status_id, $all = null)
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
