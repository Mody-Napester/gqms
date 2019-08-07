<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class RoomQueue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['floor_id', 'room_id', 'doctor_id', 'serve_source_status', 'reservation_source_serial', 'queue_number', 'status','reminder', 'call_count'];

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
    public static function getNextRoomQueueTurn($doctor_source_id)
    {
        $data['nextQueue'] = self::where('doctor_id', $doctor_source_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.room_queue_status.waiting'))
            ->where('serve_source_status', '<>', 'C')
            ->orderBy('queue_number' , 'ASC')
            ->first();

        $data['nextQueueIfDuplicates'] = self::where('doctor_id', $doctor_source_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.room_queue_status.waiting'))
            ->where('queue_number', $data['nextQueue']->queue_number)
            ->where('serve_source_status', '<>', 'C')
            ->orderBy('created_at' , 'DESC')
            ->first();

        return $data['nextQueueIfDuplicates'];

//        if($data['nextWaiting']->call_count >= 1 && $data['nextWaiting']->call_count_check = 1){
//            $data['nextWaiting'] = self::where('floor_id', $room->floor_id)
//                ->where('created_at', 'like', "%".date('Y-m-d')."%")
//                ->where('room_id', $room->id)
//                ->where('status', config('vars.room_queue_status.waiting'))
//                ->orderBy('queue_number' , $orderStatus)
//                ->skip(1)
//                ->first();
//        }else{
//
//        }

        // Get all next skipped
//        $data['nextSkipped'] = self::where('floor_id', $room->floor_id)
//            ->where('created_at', 'like', "%".date('Y-m-d')."%")
//            ->where('room_id', $room->id)
//            ->where('status', config('vars.room_queue_status.skipped'))
//            ->where('call_count', '<', config('vars.default_room_call_count_max'))
//            ->orderBy('queue_number' , $orderStatus)
//            ->first();

//        if(isset($currentQueue)){
//            if($currentQueue->status == config('vars.room_queue_status.called')){
//                $data['nextQueue'] = ($data['nextSkipped'])? $data['nextSkipped'] : $data['nextWaiting'];
//            }
//            elseif($currentQueue->status == config('vars.room_queue_status.call_from_skip')){
//                $data['nextQueue'] = ($data['nextWaiting'])? $data['nextWaiting'] : $data['nextSkipped'];
//            }
//        }else{
//            $data['nextQueue'] = $data['nextWaiting'];
//        }



//        if(isset($currentQueue) && $currentQueue->status == config('vars.room_queue_status.call_from_skip')){
//            $data['nextQueue'] = self::where('floor_id', $room->floor_id)
//                ->where('created_at', 'like', "%".date('Y-m-d')."%")
//                ->where('room_id', $room->id)
//                ->where('status', config('vars.room_queue_status.waiting'))
//                ->orderBy('queue_number' , $orderStatus)
//                ->first();
//        }
//        else{
//            $data['skipped'] = self::where('floor_id', $room->floor_id)
//                ->where('created_at', 'like', "%".date('Y-m-d')."%")
//                ->where('room_id', $room->id)
//                ->where('status', config('vars.room_queue_status.skipped'))
//                ->where('call_count', '<', config('vars.default_room_call_count_max'))
//                ->orderBy('queue_number' , $orderStatus)
//                ->first();
//
//            if ($data['skipped']){
//                $data['nextQueue'] = $data['skipped'];
//            }else{
//                $data['nextQueue'] = self::where('floor_id', $room->floor_id)
//                    ->where('created_at', 'like', "%".date('Y-m-d')."%")
//                    ->where('room_id', $room->id)
//                    ->where('status', config('vars.room_queue_status.waiting'))
//                    ->orderBy('queue_number' , $orderStatus)
//                    ->first();
//            }
//        }

    }

    /**
     *  Get Available Room Queue
     */
    public static function getAvailableRoomQueueView($floor_id, $room_id, $doctor_id = null)
    {
        if(is_null($doctor_id)){
            $data['roomQueues'] = self::getRoomQueues($floor_id, $room_id);
        }else{
            $data['roomQueues'] = self::getRoomQueues($floor_id, $room_id, $doctor_id);
        }

        $data['roomQueueStatues'] = QueueStatus::getQueueStatuses('room');
        $availableRoomQueue = view('rooms._available_room_queue', $data)->render();

        return $availableRoomQueue;
    }

    /**
     *  Get Available Room Queue
     */
    public static function getAvailableRoomQueueViewByDoctor($doctor_source_id)
    {
        $data['roomQueues'] = self::getRoomQueuesByDoctor($doctor_source_id);
        $data['roomQueueStatues'] = QueueStatus::getQueueStatuses('room');
        $availableRoomQueue = view('rooms._available_room_queue', $data)->render();

        return $availableRoomQueue;
    }

    /**
     *  Get All Room Queues
     */
    public static function getRoomQueues($floor_id = null, $room_id = null, $doctor_id = null)
    {
        $orderStatus = 'DESC';

        if (!is_null($doctor_id)){
            $roomQueues = self::where('doctor_id', $doctor_id)
                ->where('created_at', 'like', "%".date('Y-m-d')."%")
//                ->orderBy('id', $orderStatus)
                ->orderBy('queue_number' , $orderStatus)
                ->get();

            if(!$roomQueues){
                $roomQueues = self::where('floor_id', $floor_id)
                    ->where('room_id', $room_id)
                    ->where('created_at', 'like', "%".date('Y-m-d')."%")
//                ->orderBy('id', 'DESC')
                    ->orderBy('queue_number' , $orderStatus)
                    ->get();
            }
        }else{
            $roomQueues = self::where('floor_id', $floor_id)
                ->where('room_id', $room_id)
                ->where('created_at', 'like', "%".date('Y-m-d')."%")
//                ->orderBy('id', $orderStatus)
                ->orderBy('queue_number' , $orderStatus)
                ->get();
        }

        return $roomQueues;
    }

    /**
     *  Get All Room Queues
     */
    public static function getRoomQueuesByDoctor($doctor_source_id)
    {
        $doctorQueues = self::where('doctor_id', $doctor_source_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('serve_source_status', '<>', 'C')
            ->orderBy('queue_number' , 'DESC')
            ->groupBy('queue_number')
//            ->having('created_at', 'max(created_at)')
            ->get();

        return $doctorQueues;
    }


    /**
     *  Get Current Room Queue
     */
    public static function getCurrentRoomQueues($room_id)
    {
        $roomQueues = self::where('status', config('vars.room_queue_status.call_from_skip'))
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('room_id', $room_id)
            ->first();

        if(count($roomQueues) == 0){
            $roomQueues = self::where('status', config('vars.room_queue_status.patient_in'))
//                ->where('created_at', 'like', "%".date('Y-m-d')."%")
                ->where('room_id', $room_id)
                ->first();
        }

        if(count($roomQueues) == 0){
            $roomQueues = self::where('status', config('vars.room_queue_status.called'))
                ->where('created_at', 'like', "%".date('Y-m-d')."%")
                ->where('room_id', $room_id)
                ->first();
        }

        return $roomQueues;
    }

    /**
     *  Get Count Desk Queue
     */
    public static function getCountDeskQueues($status, $all = null)
    {
        $roomQueues = self::where('status', $status);

        if (is_null($all)){
            $roomQueues = $roomQueues->where('created_at', 'like', "%".date('Y-m-d')."%")->count();
        }else{
            $roomQueues = $roomQueues->count();
        }

        return $roomQueues;
    }

    /**
     *  Get Count Room Queue
     */
    public static function getCountRoomQueues($status, $all = null, $date_from = null, $date_to = null){
        $queues = self::where('status', $status);

        if (is_null($all)){
            if(is_null($date_from) && is_null($date_to)){
                $queues = $queues->where('created_at', 'like', "%".date('Y-m-d')."%")->count();
            }
            elseif (!is_null($date_from) && is_null($date_to)){
                $queues = $queues->where('created_at', 'like', "%".date($date_from)."%")->count();
            }
            else{
                $queues = $queues->where('created_at', '>=', $date_from)->where('created_at', '<=', $date_to)->count();
//                $queues = $queues->whereBetween('created_at', [$date_from, $date_to])->count();
            }
        }else{
            if(is_null($date_from) && is_null($date_to)){
                $queues = $queues->count();
            }else{
                $queues = $queues->where('created_at', '>=', $date_from)->where('created_at', '<=', $date_to)->count();
//                $queues = $queues->whereBetween('created_at', [$date_from, $date_to])->count();
            }
        }

        return $queues;
    }

    /**
     *  Add or update new queue number to doctor
     */
    public static function addOrUpdateQueueNumberToDoctor($doctor_source_id, $reservation_source_serial, $reservation_source_queue_number, $servstatus, $cashier_flag)
    {
        $queue = self::where('doctor_id', $doctor_source_id)->where('reservation_source_serial', $reservation_source_serial)->first();

        if (!is_null($queue)){
            // If Reservation canceled
            if($servstatus == 'C'){
                self::edit([
                    'serve_source_status' => $servstatus
                ], $queue->id);
            }
        }else{
            // Check Cashier flag (Reservation payed)
            if($cashier_flag == 1){
                // Add new doctor queue
                $roomQueue = self::store([
                    'floor_id' => 0,
                    'room_id' => 0,
                    'doctor_id' => $doctor_source_id,
                    'queue_number' => $reservation_source_queue_number,
                    'status' => config('vars.room_queue_status.waiting'),
                    'serve_source_status' => $servstatus,
                    'reservation_source_serial' => $reservation_source_serial,
                ]);
            }
        }

        // Trigger Doctor Queue Event
        $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueViewByDoctor($doctor_source_id);
        event(new \App\Events\RoomQueueStatus($data['availableRoomQueue'], $doctor_source_id));

        return true;
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