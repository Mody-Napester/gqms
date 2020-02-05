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
        $data['date'] = null;
        $data['all'] = null;

        if (empty($request->all())){
            $data['users'] = User::where('type', UserTypes::$typesReverse['Desk'])->groupBy('name')->paginate(50);
        }else{
            $data['users'] = new User();
            $data['users'] = $data['users']->where('type', UserTypes::$typesReverse['Desk']);

            $data['users'] = ($request->has('user'))? $data['users']->where('id', User::getBy('uuid', $request->get('user'))->id ) : $data['users'];

//            $data['users'] = ($request->has('date') && $request->date != null)? $data['users']->where('created_at', 'like', $request->date . '%') : $data['users'];

            if($request->has('date') && $request->date != null){
                $data['date'] = $request->date;
                $data['all'] = null;
            }else{
                $data['date'] = null;
                $data['all'] = 1;
            }

//            if($request->show == 0){ // Get Only Performed
//                $data['users'] = $data['users']->join('desk_queue_statuses', 'users.id', '=', 'desk_queue_statuses.user_id');
//            }

            $data['users'] = $data['users']->groupBy('name')->get();
        }

        // Store User Action Log
        storeLogUserAction(\App\Enums\LogUserActions::$name['IndexDeskReport'], 'Get',route('reports.desks.index'));

        return view('reports.desks.index', $data);
    }

    // Index Doctors Reports
    public function doctorsIndex(Request $request)
    {
//        $data['users'] = User::where('room_id', '<>', '')->get();

        $data['allUsers'] = User::where('type', UserTypes::$typesReverse['Doctor'])->groupBy('name')->get();
        $data['date'] = null;
        $data['all'] = null;

        if (empty($request->all())){
            $data['users'] = User::where('type', UserTypes::$typesReverse['Doctor'])->groupBy('name')->paginate(50);
        }else{
            $data['users'] = new User();

            $data['users'] = $data['users']->where('type', UserTypes::$typesReverse['Doctor']);

            $data['users'] = ($request->has('user'))? $data['users']->where('id', User::getBy('uuid', $request->get('user'))->id ) : $data['users'];

//            $data['users'] = ($request->has('date') && $request->date != null)? $data['users']->where('created_at', 'like', $request->date . '%') : $data['users'];

            if($request->has('date') && $request->date != null){
                $data['date'] = $request->date;
                $data['all'] = null;
            }else{
                $data['date'] = null;
                $data['all'] = 1;
            }


            $data['users'] = $data['users']->groupBy('name')->get();
        }


        // Store User Action Log
        storeLogUserAction(\App\Enums\LogUserActions::$name['IndexDoctorReport'], 'Get',route('reports.doctors.index'));

        return view('reports.doctors.index', $data);
    }
}
