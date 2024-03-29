<?php

namespace App\Http\Controllers;

use App\Area;
use App\Desk;
use App\Enums\LogUserActions;
use App\Floor;
use App\Room;
use App\Screen;
use App\User;
use Validator;
use Illuminate\Http\Request;

class FloorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!User::hasAuthority('index.floors')){
            return redirect('/');
        }

        if (empty($request->all())){
            $data['floors'] = Floor::all();
        }else{
            $data['floors'] = new Floor();

            $data['floors'] = ($request->has('name_ar'))? $data['floors']->where('name_ar',$request->get('name_ar')) : $data['floors'];
            $data['floors'] = ($request->has('name_en'))? $data['floors']->where('name_en',$request->get('name_en')) : $data['floors'];
            $data['floors'] = ($request->has('status'))? $data['floors']->where('status',$request->get('status')) : $data['floors'];

            $data['floors'] = $data['floors']->get();
        }

        // Store User Action Log
        storeLogUserAction(\App\Enums\LogUserActions::$name['IndexFloor'], 'Get',route('floors.index'));

        return view('floors.index', $data);
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
        if (!User::hasAuthority('store.floors')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = Floor::store([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status,
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

        // Store User Action Log
        storeLogUserAction(\App\Enums\LogUserActions::$name['StoreFloor'], 'Post',route('floors.store'));

        return back()->with('message', $data['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $data['floor'] = Floor::getBy('uuid', $uuid);

        // Store User Action Log
        storeLogUserAction(\App\Enums\LogUserActions::$name['EditFloor'], 'Get',route('floors.edit', $data['floor']->uuid));

        return response([
            'title'=> "Update floor " . $data['floor']->name_en,
            'view'=> view('floors.edit', $data)->render(),
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
        $resource = Floor::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = Floor::edit([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status,
            'updated_by' => auth()->user()->id
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

        // Store User Action Log
        storeLogUserAction(\App\Enums\LogUserActions::$name['UpdateFloor'], 'Put',route('floors.edit', $data['floor']->uuid));

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
        $resource = Floor::getBy('uuid', $uuid);
        if ($resource){
            $areas = Area::where('floor_id', $resource->id)->get();
            $desks = Desk::where('floor_id', $resource->id)->get();
            $rooms = Room::where('floor_id', $resource->id)->get();
            $screens = Screen::where('floor_id', $resource->id)->get();

            if($areas || $desks || $rooms || $screens){
                $data['message'] = [
                    'msg_status' => 0,
                    'type' => 'danger',
                    'text' => 'Sorry we cannot delete this floor.',
                ];
            }

            $deletedResource = Floor::remove($resource->id);

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

        // Store User Action Log
        storeLogUserAction(\App\Enums\LogUserActions::$name['DestroyUser'], 'Delete',route('floors.destroy', $data['floor']->uuid));

        return back()->with('message', $data['message']);
    }
}
