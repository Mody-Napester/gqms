<?php

namespace App\Http\Controllers;

use App\Desk;
use App\Floor;
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
            return back();
        }
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
        $resource = Floor::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Floor::remove($resource->id);

            // Return
            if ($deletedResource){
                return back();
            }
        }
    }
}
