<?php

namespace App\Http\Controllers;

use App\QueueStatus;
use App\Room;
use App\Floor;
use App\RoomQueue;
use App\RoomQueueStatus;
use App\User;
use Validator;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check permissions
        if (!User::hasAuthority('index.rooms')){
            return redirect('/');
        }

        $data['floors'] = Floor::all();

        if (empty($request->all())){
            $data['rooms'] = Room::all();
        }else{
            $data['rooms'] = new Room();

            $data['rooms'] = ($request->has('name_ar') && !empty($request->get('name_ar')))? $data['rooms']->where('name_ar',$request->get('name_ar')) : $data['rooms'];
            $data['rooms'] = ($request->has('name_en') && !empty($request->get('name_en')))? $data['rooms']->where('name_en',$request->get('name_en')) : $data['rooms'];
            $data['rooms'] = ($request->has('ip') && !empty($request->get('ip')))? $data['rooms']->where('ip',$request->get('ip')) : $data['rooms'];
            $data['rooms'] = ($request->has('status'))? $data['rooms']->where('status',$request->get('status')) : $data['rooms'];
            $data['rooms'] = ($request->has('floor'))? $data['rooms']->where('floor_id', Floor::getBy('uuid', $request->get('floor'))->id) : $data['rooms'];

            $data['rooms'] = $data['rooms']->get();

//            dd($data['rooms']->toSql());
        }

        return view('rooms.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check permissions
        if (!User::hasAuthority('store.rooms')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required',
            'ip' => 'required|unique:rooms',
            'floor' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = Room::store([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status,
            'ip' => $request->ip,
            'floor_id' => Floor::getBy('uuid', $request->floor)->id,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        // Return
        if ($resource){
            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Added successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Error! .. please try again.',
            ];
        }

        return back()->with('message', $data['message']);
    }

    /**
     * Display the resource.
     */
    public function show($uuid)
    {
        // Check permissions
        if (!User::hasAuthority('show.rooms')){
            return redirect('/');
        }

        // Get Room
        $data['room'] = Room::getBy('uuid', $uuid);

        // Room not connected to screen
        $screen_room = DB::table('screen_room')->where('room_id', $data['room']->id)->first();
        if (!$screen_room){
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Room not connected to screen',
            ];

            return back()->with('message', $data['message']);
        }

        // Check IP
        if (auth()->user()->room_id != $data['room']->id){
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'You don\'t have permission.',
            ];

            return back()->with('message', $data['message']);
        }

        // Check if user login from current room
        if (is_null(auth()->user()->room_id) || auth()->user()->login_ip != auth()->user()->room->ip){
            return redirect(route('dashboard.index'));
        }
        if (auth()->user()->room_id != $data['room']->id) {
            return redirect(route('dashboard.index'));
        }

        $data['roomQueueStatues'] = QueueStatus::getQueueStatuses('room');

        // Get today's room queues
        $data['roomQueues'] = RoomQueue::getRoomQueuesByDoctor(auth()->user()->doctor->source_doctor_id);

        $data['roomQueuesSkip'] = RoomQueueStatus::getRoomQueues(auth()->user()->id, config('vars.room_queue_status.skipped'));
        $data['roomQueuesPatientOut'] = RoomQueueStatus::getRoomQueues(auth()->user()->id, config('vars.room_queue_status.patient_out'));

        $data['currentRoomQueueNumber'] = RoomQueue::getCurrentRoomQueues($data['room']->id);

        return view('rooms.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['room'] = Room::getBy('uuid', $uuid);
        $data['floors'] = Floor::all();
        return response([
            'title'=> "Update room " . $data['room']->name_en,
            'view'=> view('rooms.edit', $data)->render(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        // Check permissions

        // Get Resource
        $resource = Room::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required',
            'ip' => 'required|unique:rooms,ip,' . $resource->id,
            'floor' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = Room::edit([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status,
            'ip' => $request->ip,
            'floor_id' => Floor::getBy('uuid', $request->floor)->id,
            'updated_by' => auth()->user()->id,
        ], $resource->id);

        // Return
        if ($updatedResource){
            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Updated successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Error! .. please try again.',
            ];
        }

        return back()->with('message', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $resource = Room::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Room::remove($resource->id);

            // Return
            if ($deletedResource){
                $data['message'] = [
                    'msg_status' => 1,
                    'type' => 'success',
                    'text' => 'Deleted successfully',
                ];
            }else{
                $data['message'] = [
                    'msg_status' => 0,
                    'type' => 'danger',
                    'text' => 'Error! .. please try again.',
                ];
            }

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Sorry, user not exists.',
            ];
        }

        return back()->with('message', $data['message']);
    }
}
