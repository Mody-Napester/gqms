<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeskQueue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['floor_id', 'queue_number', 'status'];

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
     *  Get Available Desk Queue
     */
    public static function getAvailableDeskQueueView($floor_id)
    {
        $deskQueues = self::getDeskQueues($floor_id);
        $availableDeskQueue = view('desks._available_desk_queue', compact('deskQueues'))->render();

        return $availableDeskQueue;
    }

    /**
     *  Get All Desk Queues
     */
    public static function getDeskQueues($floor_id)
    {
        $deskQueues = self::where('floor_id', $floor_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->orderBy('id', 'DESC')
            ->get();

        return $deskQueues;
    }


    /**
     *  Get Current Desk Queue
     */
    public static function getCurrentDeskQueues($desk_id)
    {
        $deskQueues = self::where('status', config('vars.queue_status.cell_from_skip'))
        ->where('created_at', 'like', "%".date('Y-m-d')."%")
        ->where('desk_id', $desk_id)
        ->first();

        if(count($deskQueues) == 0){
            $deskQueues = self::where('status', config('vars.queue_status.called'))
                ->where('created_at', 'like', "%".date('Y-m-d')."%")
                ->where('desk_id', $desk_id)
                ->first();
        }

        return $deskQueues;
    }

    /**
     *  Get Count Desk Queue
     */
    public static function getCountDeskQueues($status, $all = null)
    {
        $deskQueues = self::where('status', $status);

        if (is_null($all)){
            $deskQueues = $deskQueues->where('created_at', 'like', "%".date('Y-m-d')."%")->count();
        }else{
            $deskQueues = $deskQueues->count();
        }

        return $deskQueues;
    }


    // Floor Relation
    public function floor(){
        return $this->belongsTo('App\Floor');
    }

    // Floor Relation
    public function desk(){
        return $this->belongsTo('App\Desk');
    }

    // Queue Status Relation
    public function queueStatus(){
        return $this->belongsTo('App\QueueStatus', 'status');
    }

    // Queue Status Histories Relation
    public function deskQueueStatusHistories(){
        return $this->hasMany('App\DeskQueueStatus', 'desk_queue_id');
    }
}
