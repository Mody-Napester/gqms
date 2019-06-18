<?php

namespace App\Http\Controllers;

use App\Area;
use App\Floor;
use App\Speciality;
use App\User;
use Validator;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $speciality = Speciality::getBy('id', 1);
//        $r = ($speciality->areas)? $speciality->areas()->where('speciality_id', $speciality->id)->first() : '-';
//        dd($r);

        if (!User::hasAuthority('index.areas')){
            return redirect('/');
        }

        $data['floors'] = Floor::where('status', 1)->get();
        $data['specialities'] = Speciality::all();

        if (empty($request->all())){
            $data['areas'] = Area::all();
        }else{
            $data['areas'] = new Area();

            $data['areas'] = ($request->has('name_ar'))? $data['areas']->where('name_ar',$request->get('name_ar')) : $data['areas'];
            $data['areas'] = ($request->has('name_en'))? $data['areas']->where('name_en',$request->get('name_en')) : $data['areas'];
            $data['areas'] = ($request->has('status'))? $data['areas']->where('status',$request->get('status')) : $data['areas'];

            $data['areas'] = $data['areas']->get();
        }

        return view('areas.index', $data);
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
        if (!User::hasAuthority('store.areas')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required',
            'floor' => 'required',
            'speciality' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $floor = Floor::getBy('uuid', $request->floor);
        if (!$floor){
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Please select floor!',
            ];

            return back()->with('message', $data['message']);
        }

//        $speciality = Speciality::getBy('uuid', $request->speciality);
//        if (!$speciality){
//            $data['message'] = [
//                'msg_status' => 0,
//                'type' => 'danger',
//                'text' => 'Please select speciality!',
//            ];
//
//            return back()->with('message', $data['message']);
//        }


        // Do Code
        $area = Area::store([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status,
            'floor_id' => $floor->id,
//            'speciality_id' => $speciality->id,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        // Specialities
        foreach ($request->specialities as $speciality){
            $area->specialities()->attach(Speciality::getBy('uuid', $speciality)->id);
        }

        // Return
        if ($area){
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
        $data['area'] = Area::getBy('uuid', $uuid);
        $data['floors'] = Floor::where('status', 1)->get();
        $data['specialities'] = Speciality::all();
        return response([
            'title'=> "Update area " . $data['area']->name_en,
            'view'=> view('areas.edit', $data)->render(),
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
        $resource = Area::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required',
            'floor' => 'required',
            'specialities' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $floor = Floor::getBy('uuid', $request->floor);
        if (!$floor){
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Please select floor!',
            ];

            return back()->with('message', $data['message']);
        }

//        $speciality = Speciality::getBy('uuid', $request->speciality);
//        if (!$speciality){
//            $data['message'] = [
//                'msg_status' => 0,
//                'type' => 'danger',
//                'text' => 'Please select speciality!',
//            ];
//
//            return back()->with('message', $data['message']);
//        }

        // Do Code
        $updatedResource = Area::edit([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status,
            'floor_id' => $floor->id,
//            'speciality_id' => $speciality->id,
            'updated_by' => auth()->user()->id
        ], $resource->id);

        // Specialities
        foreach ($request->specialities as $speciality){
            $resource->specialities()->attach(Speciality::getBy('uuid', $speciality)->id);
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
        $resource = Area::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Area::remove($resource->id);

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
     * Display a listing of the resource.
     */
    public function getSpecialityToArea()
    {
        // Check permissions
//        if (!User::hasAuthority('index.doctors')){
//            return redirect('/');
//        }

        $data['areas'] = Area::getAll();
        $data['specialities'] = Speciality::getAll();
        return view('areas.speciality_to_area.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSpecialityToArea(Request $request, $area_uuid)
    {
        // Code
        if($request->has('specialities')){
            if (count($request->specialities) > 0){
                $area = Area::getBy('uuid', $area_uuid);

                if ($area){

                    $area->specialities()->detach();

                    foreach ($request->specialities as $speciality_uuid) {
                        $area->specialities()->attach(Speciality::getBy('uuid', $speciality_uuid)->id);
                    }

                    $data['message'] = [
                        'msg_status' => 1,
                        'text' => 'Updated!',
                    ];
                }else{
                    $data['message'] = [
                        'msg_status' => 0,
                        'text' => 'Area not exists!',
                    ];
                }

            }else{
                $data['message'] = [
                    'msg_status' => 0,
                    'text' => 'Speciality are empty!',
                ];
            }
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Please select speciality first!',
            ];
        }

        // Return
        return response()->json($data);
    }
}