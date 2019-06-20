<?php

namespace App\Http\Controllers;

use App\Area;
use App\Desk;
use App\DeskQueue;
use App\DeskQueueStatus;
use App\Doctor;
use App\Floor;
use App\Printer;
use App\Room;
use App\RoomQueue;
use App\Screen;
use App\ScreenType;
use App\User;
use Validator;
use Illuminate\Http\Request;

class ScreensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!User::hasAuthority('index.screens')){
            return redirect('/');
        }

        $data['screenTypes'] = ScreenType::all();
        $data['floors'] = Floor::all();
        $data['rooms'] = Room::all();
        $data['printers'] = Printer::all();
        $data['desks'] = Desk::getAll();
        $data['areas'] = Area::getAll();

        if (empty($request->all())){
            $data['screens'] = Screen::all();
        }else{
            $data['screens'] = new Screen();

            $data['screens'] = ($request->has('name_ar') && !empty($request->get('name_ar')))? $data['screens']->where('name_ar',$request->get('name_ar')) : $data['screens'];
            $data['screens'] = ($request->has('name_en') && !empty($request->get('name_en')))? $data['screens']->where('name_en',$request->get('name_en')) : $data['screens'];
            $data['screens'] = ($request->has('ip') && !empty($request->get('ip')))? $data['screens']->where('ip',$request->get('ip')) : $data['screens'];
            $data['screens'] = ($request->has('status'))? $data['screens']->where('status',$request->get('status')) : $data['screens'];
            $data['screens'] = ($request->has('floor'))? $data['screens']->where('floor_id', Floor::getBy('uuid', $request->get('floor'))->id) : $data['screens'];

            $data['screens'] = $data['screens']->get();

//            dd($data['screens']->toSql());
        }


        return view('screens.index', $data);
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
        if (!User::hasAuthority('store.screens')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255|unique:screens,name_ar',
            'name_en' => 'required|string|max:255|unique:screens,name_en',
            'status' => 'required',
            'ip' => 'required|unique:screens',
//            'floor' => 'required',
            'area' => 'required',
            'type' => 'required',
            'floors' => 'required_if:type,' . config('vars.screen_types.kiosk'),
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Floor
//        $floor = Floor::getBy('uuid', $request->floor);

        $area = Area::getBy('uuid', $request->area);

        // Generate Slug
        $slug = str_slug($request->name_en . '-' . $area->id);

        // Do Code
        $resource = Screen::store([
            'slug' => $slug,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status,
            'printer_id' => (($request->has('printer'))? Printer::getBy('uuid', $request->printer)->id : null),
            'enable_print' => (($request->enable_print == 0)? 0 : 1),
            'ip' => $request->ip,
            'area_id' => $area->id,
            'floor_id' => $area->floor->id,
            'screen_type_id' => $request->type,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        // Add Relation
        if ($request->has('type') && $request->type == config('vars.screen_types.kiosk')){
            foreach ($request->floors as $floor){
                $resource->floors()->attach(Floor::getBy('uuid', $floor)->id);
            }
        }
        if ($request->has('rooms')){
            foreach ($request->rooms as $room){
                $resource->rooms()->attach(Room::getBy('uuid', $room)->id);
            }
        }
        if ($request->has('desks')){
            foreach ($request->desks as $desk){
                $resource->desks()->attach(Desk::getBy('uuid', $desk)->id);
            }
        }

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
     * @param string $screen
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|string
     */
    public function show(string $screen)
    {
        $data['screen'] = Screen::where('uuid', $screen)->orWhere('slug', $screen)->first();

        $data['arabic_alphas'] = ['ا','إ','ب','ت','ث','ج','ح','خ','د','ذ','ر','ز','س','ش','ص','ض','ط','ظ','ع','غ','ف','ق','ك','ل','م','ن','ه','و','ى','ي'];

        if($data['screen']){
            $data['doctors'] = Doctor::all();

            if($data['screen']->screen_type_id == config('vars.screen_types.kiosk')){
                return view('screens.kiosk.show', $data);
            }
            else if($data['screen']->screen_type_id == config('vars.screen_types.reception')){
                $data['logegdInDeskUsers'] = Desk::logegdInUsers('desk_id');
                $data['logegdInRoomUsers'] = Room::logegdInUsers('room_id');

                $data['desks'] = Desk::where('floor_id', $data['screen']->floor_id)->get();
                $data['room'] = Room::where('floor_id', $data['screen']->floor_id)->get();

//                return view('screens.reception.ajax_show', $data);
            return view('screens.reception.show', $data);
            }else{
                return redirect(route('dashboard.index'));
            }
        }else{
            return request()->url();
            return 'Screen Not Found';
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|string
     */
    public function showByUnifiedUrl()
    {
        $ip = server_get_client_ip();
        $screen = Screen::where('ip', $ip)->first();
        if($screen){
            return $this->show($screen->uuid);
        }else{
            return 'Screen Not Found';
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['screen'] = Screen::getBy('uuid', $uuid);
        $data['screenTypes'] = ScreenType::all();
        $data['floors'] = Floor::all();
        $data['rooms'] = Room::all();
        $data['printers'] = Printer::all();
        $data['desks'] = Desk::getAll();
        $data['areas'] = Area::getAll();

        return response([
            'title'=> "Update screen " . $data['screen']->name_en,
            'view'=> view('screens.edit', $data)->render(),
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
        $resource = Screen::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255|unique:screens,name_ar,'. $resource->id,
            'name_en' => 'required|string|max:255|unique:screens,name_en,'. $resource->id,
            'status' => 'required',
            'ip' => 'required',
//            'floor' => 'required',
            'area' => 'required',
            'type' => 'required',
            'floors' => 'required_if:type,' . config('vars.screen_types.kiosk'),
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Area
        $area = Area::getBy('uuid', $request->area);

        // Generate Slug
        $slug = str_slug($request->name_en . '-' . $area->id);

        // Do Code
        $updatedResource = Screen::edit([
            'slug' => $slug,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status,
            'printer_id' => (($request->has('printer'))? Printer::getBy('uuid', $request->printer)->id : null),
            'enable_print' => (($request->enable_print == 0)? 0 : 1),
            'ip' => $request->ip,
            'area_id' => $area->id,
            'floor_id' => $area->floor->id,
            'screen_type_id' => $request->type,
            'updated_by' => auth()->user()->id,
        ], $resource->id);

        // Update Relation
        if ($request->has('type') && $request->type == config('vars.screen_types.kiosk')){
            $resource->floors()->detach();

            foreach ($request->floors as $floor){
                $resource->floors()->attach(Floor::getBy('uuid', $floor)->id);
            }
        }

        if ($request->has('rooms')){
            $resource->rooms()->detach();

            foreach ($request->rooms as $room){
                $resource->rooms()->attach(Room::getBy('uuid', $room)->id);
            }
        }

        if ($request->has('desks')){
            $resource->desks()->detach();

            foreach ($request->desks as $desk){
                $resource->desks()->attach(Desk::getBy('uuid', $desk)->id);
            }
        }

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
        $resource = Screen::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Screen::remove($resource->id);

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

    /**
     * Get Screens Ajax Contents.
     */
    public function getScreensAjaxContents($screen)
    {
        $data['screen'] = Screen::where('uuid', $screen)->orWhere('slug', $screen)->first();

        $data['logegdInDeskUsers'] = Desk::logegdInUsers('desk_id');
        $data['logegdInRoomUsers'] = Room::logegdInUsers('room_id');

        $data['desks'] = Desk::where('floor_id', $data['screen']->floor_id)->get();
        $data['room'] = Room::where('floor_id', $data['screen']->floor_id)->get();

        foreach($data['desks'] as $desk){
            $data['deskQueues'][$desk->uuid]['status'] = (in_array($desk->id , $data['logegdInDeskUsers']))? 1 : 0 ;
            $data['deskQueues'][$desk->uuid]['queueNumber'] = (DeskQueue::getCurrentDeskQueues($desk->id)? DeskQueue::getCurrentDeskQueues($desk->id)->queue_number : 0);
            $data['deskQueues'][$desk->uuid]['reminder'] = (DeskQueue::getCurrentDeskQueues($desk->id)? DeskQueue::getCurrentDeskQueues($desk->id)->reminder : 0);

            $getCurrentDeskQueue = DeskQueue::getCurrentDeskQueues($desk->id);
            if($getCurrentDeskQueue){
                DeskQueue::edit(['reminder' => 0], $getCurrentDeskQueue->id);
            }
        }

        foreach($data['room'] as $room){
            $data['roomQueues'][$room->uuid]['status'] = (in_array($room->id , $data['logegdInRoomUsers']))? 1 : 0 ;
            $data['roomQueues'][$room->uuid]['queueNumber'] = (RoomQueue::getCurrentRoomQueues($room->id)? RoomQueue::getCurrentRoomQueues($room->id)->queue_number : 0);
            $data['roomQueues'][$room->uuid]['reminder'] = (RoomQueue::getCurrentRoomQueues($room->id)? RoomQueue::getCurrentRoomQueues($room->id)->reminder : 0);

            $getCurrentRoomQueue = RoomQueue::getCurrentRoomQueues($room->id);
            if($getCurrentRoomQueue){
                RoomQueue::edit(['reminder' => 0], $getCurrentRoomQueue->id);
            }
        }

        unset($data['screen']);
        unset($data['logegdInDeskUsers']);
        unset($data['logegdInRoomUsers']);
        unset($data['desks']);
        unset($data['room']);

        // Return
//        return $data['deskQueues'];
        return response()->json($data);
    }

    /**
     * Get Doctors By Letter.
     */
    public function searchByLetter($letter)
    {
        $data['doctors'] = Doctor::where('name_ar', 'LIKE', $letter.'%')->get();
        $data['view'] = view('screens.kiosk._doctor_floors', $data)->render();
        return response()->json($data);
    }

    /**
     * Get Doctors By Letter.
     */
    public function filterByArea($area_uuid)
    {
        $data['desks'] = Desk::where('area_id', Area::getBy('uuid', $area_uuid)->id)->get();
        $data['view'] = view('screens._desks_areas', $data)->render();
        return response()->json($data);
    }
}
