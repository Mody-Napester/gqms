<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomQueue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['floor_id', 'room_id', 'queue_number', 'status'];

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
     *  Get a specific resource
     */
    public static function getAll($status = 1)
    {
        return self::where('status', $status)->get();
    }

    /**
     *  Get Available Room Queue
     */
    public static function getAvailableRoomQueueView($floor_id, $room_id)
    {
        $data['roomQueues'] = self::getRoomQueues($floor_id, $room_id);
        $data['roomQueueStatues'] = QueueStatus::getQueueStatuses('room');
        $availableRoomQueue = view('rooms._available_room_queue', $data)->render();

        return $availableRoomQueue;
    }

    /**
     *  Get All Room Queues
     */
    public static function getRoomQueues($floor_id, $room_id)
    {
        $roomQueues = self::where('floor_id', $floor_id)
            ->where('room_id', $room_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->orderBy('id', 'DESC')
            ->get();

        return $roomQueues;
    }


    /**
     *  Get Current Room Queue
     */
    public static function getCurrentRoomQueues($room_id)
    {
        $roomQueues = self::where('status', config('vars.desk_queue_status.call_from_skip'))
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('room_id', $room_id)
            ->first();

        if(count($roomQueues) == 0){
            $roomQueues = self::where('status', config('vars.desk_queue_status.called'))
                ->where('created_at', 'like', "%".date('Y-m-d')."%")
                ->where('room_id', $room_id)
                ->first();
        }

        return $roomQueues;
    }

    /**
     *  Get Count Room Queue
     */
    public static function getCountRoomQueues($status, $all = null)
    {
        $roomQueues = self::where('status', $status);

        if (is_null($all)){
            $roomQueues = $roomQueues->where('created_at', 'like', "%".date('Y-m-d')."%")->count();
        }else{
            $roomQueues = $roomQueues->count();
        }

        return $roomQueues;
    }


    // Floor Relation
    public function floor(){
        return $this->belongsTo('App\Floor');
    }

    // Floor Relation
    public function room(){
        return $this->belongsTo('App\Room');
    }

    // Queue Status Relation
    public function queueStatus(){
        return $this->belongsTo('App\QueueStatus', 'status');
    }

    // Queue Status Histories Relation
    public function roomQueueStatusHistories(){
        return $this->hasMany('App\RoomQueueStatus', 'room_queue_id');
    }
}