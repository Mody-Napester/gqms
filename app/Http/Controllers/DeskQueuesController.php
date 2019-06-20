<?php

namespace App\Http\Controllers;

use App\Area;
use App\Desk;
use App\DeskQueue;
use App\DeskQueueStatus;
use App\Events\NextDeskQueue;
use App\Events\QueueStatus;
use App\Events\RoomQueueStatus;
use App\Floor;
use App\Reservation;
use App\Room;
use App\RoomQueue;
use App\Screen;
use App\User;
use Validator;
use Illuminate\Http\Request;

class DeskQueuesController extends Controller
{
    public $roomQueuesController;
    /*
     * Construct
     * */
    public function __construct()
    {
        $this->roomQueuesController = new RoomQueuesController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!User::hasAuthority('index.desks')){
            return redirect('/');
        }
        $data['desks'] = Desk::all();
        $data['floors'] = Floor::all();
        return view('desks.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string $screen_uuid
     * @return \Illuminate\Http\Response
     */
    public function storeNewQueue($screen_uuid, $area_uuid)
    {
        $screen = Screen::getBy('uuid', $screen_uuid);

        $area = Area::getBy('uuid', $area_uuid);

        if($screen->screen_type_id == config('vars.screen_types.kiosk')){ // Kiosk
            // Do Code
            $resource = DeskQueue::store([
                'floor_id' => $area->floor->id,
                'area_id' => $area->id,
                'queue_number' => deskQueueNumberFormat($area, 100),
                'status' => config('vars.default_kiosk_status'),
            ]);
        }

        // Return
        if ($resource){

            if($screen->enable_print == 1){
                $printData = [
                    'queue_number' => $resource->queue_number,
//                    'screen_ip' => $screen->ip,
                    'printer_ip' => $screen->printer->ip,
                    'floor' => $screen->area->floor->name_en,
                ];

                \EPSON::deskPrint($printData);
            }

            $data['availableDeskQueue'] = DeskQueue::getAvailableDeskQueueView($area->id);
            $data['queue_number'] = $resource->queue_number;

            event(new QueueStatus($data['availableDeskQueue'], $area->id));

            return response($data);
        }
    }
    
    /**
     * Call Next Queue Number.
     */
    public function callNext($desk_uuid)
    {
        $data['desk'] = Desk::getBy('uuid', $desk_uuid);
        $data['nextQueue'] = DeskQueue::where('area_id', $data['desk']->area_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.desk_queue_status.waiting'))
            ->first();

        if($data['nextQueue']){
            // Do Code
            $data['nextDeskQueueUpdated'] = DeskQueue::edit([
                'desk_id' => $data['desk']->id,
                'status' => config('vars.desk_queue_status.called'),
            ], $data['nextQueue']->id);

            $deskQueueStatusDone = DeskQueueStatus::store([
                'user_id' => auth()->user()->id,
                'desk_queue_id' => $data['nextQueue']->id,
                'queue_status_id' => config('vars.desk_queue_status.called'),
            ]);

            $data['availableDeskQueue'] = DeskQueue::getAvailableDeskQueueView($data['desk']->area_id);

            $data['waitingTime'] = nice_time($data['nextQueue']->created_at);

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Your next number has come',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Broadcast event
        if (isset($data['nextDeskQueueUpdated'])){
            event(new QueueStatus($data['availableDeskQueue'], $data['desk']->area_id));
            event(new NextDeskQueue($data['desk']->uuid, $data['nextQueue']->queue_number));
        }

        // Return
        return $data;
    }

    /**
     * Call Next Queue Number.
     */
    public function callNextQueueNumber($desk_uuid)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $data = $this->callNext($desk_uuid);

        // Return
        return response()->json($data);
    }

    /**
     * Call Next Queue Number.
     */
    public function callNextQueueNumberAgain($desk_uuid)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $data['desk'] = Desk::getBy('uuid', $desk_uuid);

        $data['nextQueue'] = DeskQueue::where('area_id', $data['desk']->area_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('desk_id', $data['desk']->id)
            ->where('status', config('vars.desk_queue_status.called'))
            ->orWhere('status', config('vars.desk_queue_status.call_from_skip'))
            ->first();

        if($data['nextQueue']){
            // Do Code
            $data['nextDeskQueueUpdated'] = DeskQueue::edit([
                'reminder' => 1,
            ], $data['nextQueue']->id);
        }

        event(new NextDeskQueue($data['desk']->uuid, $data['nextQueue']->queue_number));

        $data['message'] = [
            'msg_status' => 1,
            'text' => 'Queue number reminded',
        ];

        // Return
        return response()->json($data);
    }

    /**
     * Call Skipped Queue Number.
     */
    public function callSkippedAgain($desk_uuid, $queue_uuid)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $data['skippedQueue'] = DeskQueue::getBy('uuid', $queue_uuid);
        $data['desk'] = Desk::getBy('uuid', $desk_uuid);

        $data['currentQueue'] = DeskQueue::getCurrentDeskQueues($data['desk']->id);

        // Do Code
        if($data['currentQueue']){
            // Edit current
            DeskQueueStatus::where('desk_queue_id', $data['currentQueue']->id)->delete();

            DeskQueue::edit([
                'desk_id' => $data['desk']->id,
                'status' => config('vars.desk_queue_status.waiting'),
            ], $data['currentQueue']->id);
        }

        // Edit skipped
        DeskQueue::edit([
            'desk_id' => $data['desk']->id,
            'status' => config('vars.desk_queue_status.call_from_skip'),
        ], $data['skippedQueue']->id);

        // Do Code
        $deskQueueStatusSkip = DeskQueueStatus::store([
            'user_id' => auth()->user()->id,
            'desk_queue_id' => $data['skippedQueue']->id,
            'queue_status_id' => config('vars.desk_queue_status.call_from_skip'),
        ]);

        if($deskQueueStatusSkip){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Called skipped number',
            ];

            $data['availableDeskQueue'] = DeskQueue::getAvailableDeskQueueView($data['desk']->area_id);
            $data['waitingTime'] = nice_time($data['skippedQueue']->created_at);
            $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.skipped'));
            $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.done'));

            // Broadcast event
            event(new QueueStatus($data['availableDeskQueue'], $data['desk']->area_id));
            event(new NextDeskQueue($data['desk']->uuid, $data['skippedQueue']->queue_number));

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        return response()->json($data);

    }

    /**
     * Skip Queue Number.
     */
    public function skipQueueNumber($desk_uuid, $desk_queue_uuid, $fromCode = false)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $deskQueue = DeskQueue::getBy('uuid', $desk_queue_uuid);

        $data['desk'] = Desk::getBy('uuid', $desk_uuid);

        // Do Code
        DeskQueue::edit([
            'desk_id' => $data['desk']->id,
            'status' => config('vars.desk_queue_status.skipped'),
        ], $deskQueue->id);

        // Do Code
        $deskQueueStatusSkip = DeskQueueStatus::store([
            'user_id' => auth()->user()->id,
            'desk_queue_id' => $deskQueue->id,
            'queue_status_id' => config('vars.desk_queue_status.skipped'),
        ]);


        if($deskQueueStatusSkip){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Queue number skipped successfully',
            ];

            $data['availableDeskQueue'] = DeskQueue::getAvailableDeskQueueView($data['desk']->area_id);

            $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.skipped'));
            $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.done'));

            // Broadcast event
            event(new QueueStatus($data['availableDeskQueue'], $data['desk']->area_id));
//            event(new NextDeskQueue($data['desk']->uuid, $deskQueue->queue_number));

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        if($fromCode){
            return $data;
        }else{
            return response()->json($data);
        }

    }

    /**
     * Skip And Next Queue Number.
     */
    public function goSkipAndNextQueueNumber($desk_uuid, $desk_queue_uuid)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $deskQueue = DeskQueue::getBy('uuid', $desk_queue_uuid);

        // Do Code
        DeskQueue::edit([
            'desk_id' => Desk::getBy('uuid', $desk_uuid)->id,
            'status' => config('vars.desk_queue_status.skipped'),
        ], $deskQueue->id);

        // Do Code
        $deskQueueStatusSkip = DeskQueueStatus::store([
            'user_id' => auth()->user()->id,
            'desk_queue_id' => $deskQueue->id,
            'queue_status_id' => config('vars.desk_queue_status.skipped'),
        ]);

        if($deskQueueStatusSkip){

            $data = $this->callNext($desk_uuid);

            if ($data['message']['msg_status'] == 1){
                $data['message'] = [
                    'msg_status' => 1,
                    'text' => 'Queue was skipped successfully with getting next number',
                ];
            }else{
                $data['message'] = [
                    'msg_status' => 1,
                    'text' => 'Queue was skipped successfully with no next number',
                ];
            }

            $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.skipped'));
            $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.done'));

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        return $data;

    }

    /**
     * Skip And Next Queue Number.
     */
    public function skipAndNextQueueNumber($desk_uuid, $desk_queue_uuid)
    {
        // Check if there is a waiting patient
        $data['desk'] = Desk::getBy('uuid', $desk_uuid);
        $data['nextQueue'] = DeskQueue::where('area_id', $data['desk']->area_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.desk_queue_status.waiting'))
            ->first();

        if($data['nextQueue']){
            $data = $this->goSkipAndNextQueueNumber($desk_uuid, $desk_queue_uuid);
        }else{
            $data = $this->skipQueueNumber($desk_uuid, $desk_queue_uuid, true);
        }

        // Return
        return response()->json($data);
    }

    /**
     * Done Queue Number.
     */
    public function checkReservationSerial($reservation_serial){
        $reservation = Reservation::getBy('source_reservation_serial', $reservation_serial);

        if ($reservation){
            $room = $reservation->doctor->user->room;
//            if(empty($reservation->desk_queue_id)){
//                $data['serial'] = $reservation->source_reservation_serial;
//                $data['patient'] = ($reservation->patient)? $reservation->patient->name_en : '';
//                $data['doctor'] = ($reservation->doctor)? $reservation->doctor->name_en : '';
//                $data['clinic'] = ($reservation->clinic)? $reservation->clinic->name_en : '';
//
//                $data['message'] = [
//                    'msg_status' => 1,
//                    'text' => 'Reservation exists',
//                ];
//            }else{
//                $data['message'] = [
//                    'msg_status' => 0,
//                    'text' => 'Reservation already routed to room ' . $room->name_en,
//                ];
//            }
            if ($room){
                if(empty($reservation->desk_queue_id)){
                    if ($reservation->patient){
                        $data['serial'] = $reservation->source_reservation_serial;
                        $data['patient'] = $reservation->patient->name_en;
                        $data['doctor'] = $reservation->doctor->name_en;
                        $data['clinic'] = $reservation->clinic->name_en;

                        $data['message'] = [
                            'msg_status' => 1,
                            'text' => 'Reservation exists',
                        ];
                    }else{
                        $data['message'] = [
                            'msg_status' => 0,
                            'text' => 'Patient not exists or not synced yet',
                        ];
                    }
                }else{
                    $data['message'] = [
                        'msg_status' => 0,
                        'text' => 'Reservation already routed to room ' . $room->name_en,
                    ];
                }
            }else{
                $data['message'] = [
                    'msg_status' => 0,
                    'text' => 'Reservation exists but doctor not available',
                ];
            }
        }

//        else{
//            // Sync reservations
//            $sync = new SyncVendorDataController();
//            if ($sync->getClientReservations()){
//                $reservation = Reservation::getBy('source_reservation_serial', $reservation_serial);
//
//                if ($reservation){
//                    $room = $reservation->doctor->user->room;
//                    if(empty($reservation->desk_queue_id)){
//                        $data['serial'] = $reservation->source_reservation_serial;
//                        $data['patient'] = ($reservation->patient)? $reservation->patient->name_en : '';
//                        $data['doctor'] = ($reservation->doctor)? $reservation->doctor->name_en : '';
//                        $data['clinic'] = ($reservation->clinic)? $reservation->clinic->name_en : '';
//
//                        $data['message'] = [
//                            'msg_status' => 1,
//                            'text' => 'Reservation exists',
//                        ];
//                    }else{
//                        $data['message'] = [
//                            'msg_status' => 0,
//                            'text' => 'Reservation already routed to room ' . $room->name_en,
//                        ];
//                    }
//                }else{
//                    $data['message'] = [
//                        'msg_status' => 0,
//                        'text' => 'Reservation not found',
//                    ];
//                }
//
//            }else{
//                $data['message'] = [
//                    'msg_status' => 0,
//                    'text' => 'Reservation not found or connection failed',
//                ];
//            }
//
//        }

        else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Reservation not found',
            ];
        }

        // Return
        return response()->json($data);
    }

    /**
     * Done Queue Number.
     */
    public function doneQueueNumber($desk_uuid, $desk_queue_uuid, $reservation_serial, $fromCode = false)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $deskQueue = DeskQueue::getBy('uuid', $desk_queue_uuid);

        $data['desk'] = Desk::getBy('uuid', $desk_uuid);

        // Do Code
        DeskQueue::edit([
            'desk_id' => $data['desk']->id,
            'status' => config('vars.desk_queue_status.done'),
        ], $deskQueue->id);

        // Do Code
        $deskQueueStatusDone = DeskQueueStatus::store([
            'user_id' => auth()->user()->id,
            'desk_queue_id' => $deskQueue->id,
            'queue_status_id' => config('vars.desk_queue_status.done'),
        ]);

        if($deskQueueStatusDone){
            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Queue was done successfully with getting next number',
            ];

            $data['availableDeskQueue'] = DeskQueue::getAvailableDeskQueueView($data['desk']->area_id);

            $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.skipped'));
            $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.done'));

            // Broadcast event
            event(new QueueStatus($data['availableDeskQueue'], $data['desk']->area_id));
//            event(new NextDeskQueue($data['desk']->uuid, $deskQueue->queue_number));

            /*
             * Handle Room Queues
             * */
            $this->roomQueuesController->storeNewQueue($reservation_serial, $data['desk'], $deskQueue);

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        if($fromCode){
            return $data;
        }else{
            return response()->json($data);
        }
    }

    /**
     * Done And Next Queue Number.
     */
    public function goDoneAndNextQueueNumber($desk_uuid, $desk_queue_uuid, $reservation_serial)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $deskQueue = DeskQueue::getBy('uuid', $desk_queue_uuid);

        // Do Code
        DeskQueue::edit([
            'desk_id' => Desk::getBy('uuid', $desk_uuid)->id,
            'status' => config('vars.desk_queue_status.done'),
        ], $deskQueue->id);

        // Do Code
        $deskQueueStatusDone = DeskQueueStatus::store([
            'user_id' => auth()->user()->id,
            'desk_queue_id' => $deskQueue->id,
            'queue_status_id' => config('vars.desk_queue_status.done'),
        ]);

        if($deskQueueStatusDone){
            $data = $this->callNext($desk_uuid);

            $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.skipped'));
            $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.done'));

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Queue was done successfully with getting next number',
            ];

            /*
             * Handle Room Queues
             * */
            $this->roomQueuesController->storeNewQueue($reservation_serial, $data['desk'], $deskQueue);

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        return $data;
    }

    /**
     * Done And Next Queue Number.
     */
    public function doneAndNextQueueNumber($desk_uuid, $desk_queue_uuid, $reservation_serial)
    {
        // Check if there is a waiting patient
        $data['desk'] = Desk::getBy('uuid', $desk_uuid);

        $data['nextQueue'] = DeskQueue::where('area_id', $data['desk']->area_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.desk_queue_status.waiting'))
            ->first();

        if($data['nextQueue']){
            $data = $this->goDoneAndNextQueueNumber($desk_uuid, $desk_queue_uuid, $reservation_serial);
        }else{
            $data = $this->doneQueueNumber($desk_uuid, $desk_queue_uuid, $reservation_serial, true);
        }

        // Return
        return response()->json($data);
    }

    /**
     * All queue histories.
     */
    public function deskQueueHistory()
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $data['desks'] = Desk::all();
        $data['floors'] = Floor::all();
        $data['users'] = User::all();
        $data['statuses'] = \App\QueueStatus::getQueueStatuses('desk');
        $data['deskQueues'] = DeskQueue::all();
        return view('desks.history', $data);

    }
    /**
     * Single queue histories.
     */
    public function deskQueueSingleHistory($queue_uuid) // Ajax
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $data['deskQueue'] = DeskQueue::getBy('uuid', $queue_uuid);
        return response([
            'title'=> "All History for queue number " . "(" . $data['deskQueue']->queue_number . ")",
            'view'=> view('desks._desk_queue_history', $data)->render(),
        ]);

    }
}
