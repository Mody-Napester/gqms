<?php

namespace App\Http\Controllers;

use App\Printer;
use App\User;
use Validator;
use Illuminate\Http\Request;

class PrintersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check permissions
        if (!User::hasAuthority('index.printers')){
            return redirect('/');
        }
        
        if (empty($request->all())){
            $data['printers'] = Printer::all();
        }else{
            $data['printers'] = new Printer();

            $data['printers'] = ($request->has('name_ar') && !empty($request->get('name_ar')))? $data['printers']->where('name_ar',$request->get('name_ar')) : $data['printers'];
            $data['printers'] = ($request->has('name_en') && !empty($request->get('name_en')))? $data['printers']->where('name_en',$request->get('name_en')) : $data['printers'];
            $data['printers'] = ($request->has('ip') && !empty($request->get('ip')))? $data['printers']->where('ip',$request->get('ip')) : $data['printers'];

            $data['printers'] = $data['printers']->get();
        }

        return view('printers.index', $data);
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
        if (!User::hasAuthority('store.printers')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'ip' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = Printer::store([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'ip' => $request->ip,
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
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['printer'] = Printer::getBy('uuid', $uuid);
        return response([
            'title'=> "Update printer " . $data['printer']->name_en,
            'view'=> view('printers.edit', $data)->render(),
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
        $resource = Printer::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'ip' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = Printer::edit([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'ip' => $request->ip,
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
        $resource = Printer::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Printer::remove($resource->id);

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
