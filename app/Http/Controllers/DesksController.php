<?php

namespace App\Http\Controllers;

use App\Desk;
use App\DeskQueue;
use App\DeskQueueStatus;
use App\Floor;
use App\QueueStatus;
use App\User;
use Validator;
use Illuminate\Http\Request;

class DesksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check permissions
        if (!User::hasAuthority('index.desks')){
            return redirect('/');
        }

        $data['floors'] = Floor::all();

        if (empty($request->all())){
            $data['desks'] = Desk::all();
        }else{
            $data['desks'] = new Desk();

            $data['desks'] = ($request->has('name_ar') && !empty($request->get('name_ar')))? $data['desks']->where('name_ar',$request->get('name_ar')) : $data['desks'];
            $data['desks'] = ($request->has('name_en') && !empty($request->get('name_en')))? $data['desks']->where('name_en',$request->get('name_en')) : $data['desks'];
            $data['desks'] = ($request->has('ip') && !empty($request->get('ip')))? $data['desks']->where('ip',$request->get('ip')) : $data['desks'];
            $data['desks'] = ($request->has('status'))? $data['desks']->where('status',$request->get('status')) : $data['desks'];
            $data['desks'] = ($request->has('floor'))? $data['desks']->where('floor_id', Floor::getBy('uuid', $request->get('floor'))->id) : $data['desks'];

            $data['desks'] = $data['desks']->get();

//            dd($data['desks']->toSql());
        }

        return view('desks.index', $data);
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
        if (!User::hasAuthority('store.desks')){
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
        $resource = Desk::store([
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
        if (!User::hasAuthority('show.desks')){
            return redirect('/');
        }

        $data['desk'] = Desk::getBy('uuid', $uuid);

        // Check if user login from current desk
        if (is_null(auth()->user()->desk_id) || auth()->user()->login_ip != auth()->user()->desk->ip){
            return redirect(route('dashboard.index'));
        }
        if (auth()->user()->desk_id != $data['desk']->id) {
            return redirect(route('dashboard.index'));
        }

        $data['deskQueueStatues'] = QueueStatus::getQueueStatuses('desk');

        // Get today's desk queues
        $data['deskQueues'] = DeskQueue::getDeskQueues($data['desk']->floor_id);
        $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, 3);
        $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, 4);

        $data['currentDeskQueueNumber'] = DeskQueue::getCurrentDeskQueues($data['desk']->id);

        return view('desks.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['desk'] = Desk::getBy('uuid', $uuid);
        $data['floors'] = Floor::all();
        return response([
            'title'=> "Update desk " . $data['desk']->name_en,
            'view'=> view('desks.edit', $data)->render(),
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
        $resource = Desk::getBy('uuid', $uuid);

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
        $updatedResource = Desk::edit([
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
        $resource = Desk::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Desk::remove($resource->id);

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
