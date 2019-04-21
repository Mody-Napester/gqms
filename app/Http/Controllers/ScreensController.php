<?php

namespace App\Http\Controllers;

use App\Desk;
use App\DeskQueue;
use App\DeskQueueStatus;
use App\Floor;
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
    public function index()
    {
        if (!User::hasAuthority('index.screens')){
            return redirect('/');
        }
        $data['screens'] = Screen::all();
        $data['screenTypes'] = ScreenType::all();
        $data['floors'] = Floor::all();
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required',
            'ip' => 'required',
            'floor' => 'required',
            'type' => 'required',
            'floors' => 'required_if:type,' . config('vars.screen_types.kiosk'),
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Floor
        $floor = Floor::getBy('uuid', $request->floor);

        // Generate Slug
        $slug = str_slug($floor->name_en . '-' . $request->name_en);

        // Do Code
        $resource = Screen::store([
            'slug' => $slug,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status,
            'ip' => $request->ip,
            'floor_id' => $floor->id,
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
    public function show($screen)
    {
        $data['screen'] = Screen::where('uuid', $screen)->orWhere('slug', $screen)->first();

        if($data['screen']->screen_type_id == config('vars.screen_types.kiosk')){
            return view('screens.kiosk.show', $data);
        }
        else if($data['screen']->screen_type_id == config('vars.screen_types.reception')){
            $data['logegdInUsers'] = Desk::logegdInUsers('desk_id');
            $data['desks'] = Desk::where('floor_id', $data['screen']->floor_id)->get();
            return view('screens.reception.show', $data);
        }else{
            return redirect(route('dashboard.index'));
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required',
            'ip' => 'required',
            'floor' => 'required',
            'type' => 'required',
            'floors' => 'required_if:type,' . config('vars.screen_types.kiosk'),
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Floor
        $floor = Floor::getBy('uuid', $request->floor);

        // Generate Slug
        $slug = str_slug($floor->name_en . '-' . $request->name_en);

        // Do Code
        $updatedResource = Screen::edit([
            'slug' => $slug,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status,
            'ip' => $request->ip,
            'floor_id' => $floor->id,
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
        $resource = Screen::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Screen::remove($resource->id);

            // Return
            if ($deletedResource){
                return back();
            }
        }
    }
}
