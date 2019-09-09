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
                    'floor' => $area->floor->name_en,
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
            $data['haveWaiting'] = 1;

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
        }
        else{
            $data['haveWaiting'] = 0;
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        if($data['haveWaiting'] == 1){
            // Broadcast event
            if (isset($data['nextDeskQueueUpdated'])){
                event(new QueueStatus($data['availableDeskQueue'], $data['desk']->area_id));
                event(new NextDeskQueue($data['desk']->uuid, $data['nextQueue']->queue_number));
            }
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
            ->where(function ($q){
                $q->where('status', config('vars.desk_queue_status.called'));
                $q->orWhere('status', config('vars.desk_queue_status.call_from_skip'));
            })
            ->first();

        if($data['nextQueue']){
            // Do Code
            $data['nextDeskQueueUpdated'] = DeskQueue::edit([
                'reminder' => $data['nextQueue']->reminder + 1,
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
    public function checkReservationExists($reservation_resource){

        $reservations = Reservation::where('source_reservation_serial', $reservation_resource)
            ->orWhere('patientid', $reservation_resource)->get();

        if(count($reservations) > 0){
            foreach ($reservations as $key => $reservation){
                $room = ($reservation->doctor)? $reservation->doctor->user->room : false;

                $data['reservations'][$key]['serial'] = $reservation->source_reservation_serial;
                $data['reservations'][$key]['patient'] = ($reservation->patient)? $reservation->patient->name_ar : '-';
                $data['reservations'][$key]['doctor'] = ($reservation->doctor)? $reservation->doctor->name_ar : '-';
                $data['reservations'][$key]['clinic'] = ($reservation->clinic)? $reservation->clinic->name_ar : '-';

                if(empty($reservation->desk_queue_id)){ // Check if reservation already routed to desk before
                    if ($reservation->patient){

                        $data['reservations'][$key]['serial'] = $reservation->source_reservation_serial;
                        $data['reservations'][$key]['patient'] = ($reservation->patient)? $reservation->patient->name_ar : '-';
                        $data['reservations'][$key]['doctor'] = ($reservation->doctor)? $reservation->doctor->name_ar : '-';
                        $data['reservations'][$key]['clinic'] = ($reservation->clinic)? $reservation->clinic->name_ar : '-';

                        if ($room){ // Check doctor in room room
                            $data['reservations'][$key]['room'] = 1;
                        }else{
                            $data['reservations'][$key]['room'] = 1;
                            $data['messages'][$key] = [
                                'msg_status' => 2,
                                'text' => 'Reservation of serial ('. $reservation->source_reservation_serial .') exists but doctor not in room',
                            ];
                        }

                        $data['message'] = [
                            'msg_status' => 1,
                            'text' => 'Reservation Found',
                        ];
                    }
                    else{
                        $data['reservations'][$key]['room'] = 0;

                        $data['messages'][$key] = [
                            'msg_status' => 0,
                            'text' => 'Patient for reservation of serial ('. $reservation->source_reservation_serial .') is not exists or not synced yet',
                        ];
                    }
                }else{
                    $data['reservations'][$key]['room'] = 0;
                    $data['reservations'][$key]['routed'] = 1;

                    $data['reservations'][$key]['serial'] = $reservation->source_reservation_serial;
                    $data['reservations'][$key]['patient'] = ($reservation->patient)? $reservation->patient->name_ar : '-';
                    $data['reservations'][$key]['doctor'] = ($reservation->doctor)? $reservation->doctor->name_ar : '-';
                    $data['reservations'][$key]['clinic'] = ($reservation->clinic)? $reservation->clinic->name_ar : '-';

                    $data['messages'][$key] = [
                        'msg_status' => 0,
                        'text' => 'Reservation of serial ('. $reservation->source_reservation_serial .') already routed to room ' . $room->name_en,
                    ];
                }
            }

            $data['message'] = [
                'msg_status' => 1,
                'text' => count($reservations) . ' Reservations Found',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'No Reservations Found!',
            ];
        }

        if(isset($data['reservations'])){
            $data['view'] = view('desks._patient_reservations', $data)->render();
        }else{
            $data['view'] = 'No Data';
        }

        /* Archived Logic */
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

        /*
         * Handle Room Queues
         * */
//        $storeRoomQueue = $this->roomQueuesController->storeNewQueue($reservation_serial, $data['desk'], $deskQueue);

//        if($storeRoomQueue == true){
//
//        }else{
//            $data['message'] = [
//                'msg_status' => 0,
//                'text' => 'Some thing error in room .. no next, please try again after few minutes',
//            ];
//        }

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

        // Update reservation
        $reservation = Reservation::getBy('source_reservation_serial', $reservation_serial);
        $updatedReservation = $reservation->update([
            'desk_queue_id' => $deskQueue->id,
        ]);

        if($deskQueueStatusDone){
            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Queue was done successfully',
            ];

            $data['haveWaiting'] = 0;

            $data['availableDeskQueue'] = DeskQueue::getAvailableDeskQueueView($data['desk']->area_id);

            $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.skipped'));
            $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.desk_queue_status.done'));

            // Broadcast event
            event(new QueueStatus($data['availableDeskQueue'], $data['desk']->area_id));

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error in desk .. no next, please try again after few minutes',
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

        $data = [];

        $deskQueue = DeskQueue::getBy('uuid', $desk_queue_uuid);
        $data['desk'] = Desk::getBy('uuid', $desk_uuid);

        $data['nextQueue'] = DeskQueue::where('area_id', $data['desk']->area_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.desk_queue_status.waiting'))
            ->first();

        /*
         * Handle Room Queues
         * */
//        $storeRoomQueue = $this->roomQueuesController->storeNewQueue($reservation_serial, $data['desk'], $deskQueue);

//        if($storeRoomQueue == true){
//
//
//        }else{
//            $data['message'] = [
//                'msg_status' => 0,
//                'text' => 'Some thing error in room !, please try again after few minutes',
//            ];
//        }

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

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error in desk, please try again after few minutes',
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
    public function deskQueueHistory(Request $request)
    {
        if (!User::hasAuthority('use.desk_queue_history')){
            return redirect('/');
        }

//        dd($request->all());

        $data['desk_names'] = Desk::all();
        $data['floors'] = Floor::all();
        $data['users'] = User::all();
        $data['areas'] = Area::all();
        $data['statuses'] = \App\QueueStatus::getQueueStatuses('desk');
//        $data['deskQueues'] = DeskQueue::all();

        if (empty($request->all())){
            $data['deskQueues'] = DeskQueue::paginate(20);
        }else{
            $data['deskQueues'] = new DeskQueue();

            $data['deskQueues'] = ($request->has('queue_number') && $request->queue_number != null)? $data['deskQueues']->where('queue_number',$request->queue_number) : $data['deskQueues'];
            $data['deskQueues'] = ($request->has('area'))? $data['deskQueues']->where('area_id', Area::getBy('uuid', $request->area)->id ) : $data['deskQueues'];
            $data['deskQueues'] = ($request->has('floor'))? $data['deskQueues']->where('floor_id',Floor::getBy('uuid', $request->floor)->id ) : $data['deskQueues'];
            $data['deskQueues'] = ($request->has('desk'))? $data['deskQueues']->where('desk_id',Desk::getBy('uuid', $request->desk)->id ) : $data['deskQueues'];
            $data['deskQueues'] = ($request->has('status'))? $data['deskQueues']->where('status', \App\QueueStatus::where('uuid', $request->status)->first()->id) : $data['deskQueues'];
//            $data['deskQueues'] = ($request->has('date') && $request->date != null)? $data['deskQueues']->where('created_at', 'like', $request->date . '%') : $data['deskQueues'];

            if($request->has('date_from') && $request->date_from != null || $request->has('date_from') && $request->date_from != null){
                $data['deskQueues'] = $data['deskQueues']->whereBetween('created_at', [$request->date_from, $request->date_to]);
            }

            $data['deskQueues'] = $data['deskQueues']->get();
        }

        return view('desks.history', $data);

    }
    /**
     * Single queue histories.
     */
    public function deskQueueSingleHistory($queue_uuid) // Ajax
    {
        if (!User::hasAuthority('use.desk_queue_history')){
            return redirect('/');
        }

        $data['deskQueue'] = DeskQueue::getBy('uuid', $queue_uuid);
        return response([
            'title'=> "All History for queue number " . "(" . $data['deskQueue']->queue_number . ")",
            'view'=> view('desks._desk_queue_history', $data)->render(),
        ]);

    }
}
