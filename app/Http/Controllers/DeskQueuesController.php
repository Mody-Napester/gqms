<?php

namespace App\Http\Controllers;

use App\Desk;
use App\DeskQueue;
use App\Floor;
use App\Screen;
use App\User;
use Validator;
use Illuminate\Http\Request;

class DeskQueuesController extends Controller
{
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
    public function store($screen_uuid)
    {
        $screen = Screen::getBy('uuid', $screen_uuid);

        if($screen->screen_type_id == 1){ // Kiosk
            // Do Code
            $resource = DeskQueue::store([
                'floor_id' => $screen->floor_id,
                'queue_number' => DeskQueue::where('floor_id', $screen->floor_id)->count() + 1,
                'status' => config('vars.default_kiosk_status'),
            ]);
        }

        // Return
        if ($resource){
            return back();
        }
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        // Check Permission
        if (!User::hasAuthority('show.desks')){
            return redirect('/');
        }
        $data['desk'] = Desk::getBy('uuid', $uuid);
        return view('desks.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
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
        $resource = Desk::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Desk::remove($resource->id);

            // Return
            if ($deletedResource){
                return back();
            }
        }
    }
}
