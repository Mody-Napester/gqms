<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    // Index Desks Reports
    public function desksIndex(Request $request)
    {
//        $data['users'] = User::where('desk_id', '<>', '')->get();

        $data['allUsers'] = User::where('type', UserTypes::$typesReverse['Desk'])->groupBy('name')->get();

        if (empty($request->all())){
            $data['users'] = User::where('type', UserTypes::$typesReverse['Desk'])->groupBy('name')->paginate(50);
        }else{
            $data['floors'] = new Floor();

            $data['floors'] = ($request->has('name_ar'))? $data['floors']->where('name_ar',$request->get('name_ar')) : $data['floors'];
            $data['floors'] = ($request->has('name_en'))? $data['floors']->where('name_en',$request->get('name_en')) : $data['floors'];
            $data['floors'] = ($request->has('status'))? $data['floors']->where('status',$request->get('status')) : $data['floors'];

            $data['floors'] = $data['floors']->get();
        }

        // Store User Action Log
        storeLogUserAction(\App\Enums\LogUserActions::$name['IndexDeskReport'], 'Get',route('floors.index'));

        return view('reports.desks.index', $data);
    }

    // Index Doctors Reports
    public function doctorsIndex(Request $request)
    {
//        $data['users'] = User::where('room_id', '<>', '')->get();

        $data['allUsers'] = User::where('type', UserTypes::$typesReverse['Doctor'])->groupBy('name')->get();
        $data['users'] = User::where('type', UserTypes::$typesReverse['Doctor'])->groupBy('name')->paginate(50);

        return view('reports.doctors.index', $data);
    }
}
