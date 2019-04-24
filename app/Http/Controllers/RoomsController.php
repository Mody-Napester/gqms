<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        // Check permissions
        if (!User::hasAuthority('index.rooms')){
            return redirect('/');
        }

        $data['rooms'] = Room::all();
        $data['floors'] = Floor::all();
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
            'ip' => 'required',
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
            return back();
        }
    }

    /**
     * Display the resource.
     */
    public function show($uuid)
    {
        if (!User::hasAuthority('show.rooms')){
            return redirect('/');
        }

        $data['room'] = Room::getBy('uuid', $uuid);

        // Check if user login from current room
        if (is_null(auth()->user()->room_id) || auth()->user()->login_ip != auth()->user()->room->ip){
            return redirect(route('dashboard.index'));
        }
        if (auth()->user()->room_id != $data['room']->id) {
            return redirect(route('dashboard.index'));
        }

        // Get today's room queues
        $data['roomQueues'] = RoomQueue::getRoomQueues($data['room']->floor_id);
        
        $data['roomQueuesSkip'] = RoomQueueStatus::getRoomQueues(auth()->user()->id, 3);
        $data['roomQueuesDone'] = RoomQueueStatus::getRoomQueues(auth()->user()->id, 4);

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
            'ip' => 'required',
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
            return back();
        }
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
                return back();
            }
        }
    }
}
