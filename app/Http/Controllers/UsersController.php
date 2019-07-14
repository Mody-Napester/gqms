<?php

namespace App\Http\Controllers;

use App\Desk;
use App\Events\DeskStatus;
use App\Events\RoomStatus;
use App\Permission;
use App\PermissionGroup;
use App\Role;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
{
    /**
     * Class object
     * @var resource
     */
    public $resource;

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->resource = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check permissions
        if (!User::hasAuthority('index.users')){
            return redirect('/');
        }

        $data['roles'] = Role::all();

        if (empty($request->all())){
            $data['users'] = User::all();
        }else{

//            dd($request->all());

            $data['users'] = new User();

            $data['users'] = ($request->has('email') && !is_null($request->email))? $data['users']->where('email',$request->get('email')) : $data['users'];
            $data['users'] = ($request->has('name') && !is_null($request->name))? $data['users']->where('name',$request->get('name')) : $data['users'];
            $data['users'] = ($request->has('phone') && !is_null($request->phone))? $data['users']->where('phone',$request->get('phone')) : $data['users'];
            $data['users'] = ($request->has('status'))? $data['users']->where('status',$request->get('status')) : $data['users'];
            $data['users'] = ($request->has('type'))? $data['users']->where('type',$request->get('type')) : $data['users'];

            $data['users'] = $data['users']->get();
        }

        // Store User Action Log
        storeLogUserAction(\App\Enums\LogUserActions::$name['IndexUser'], 'Get',route('users.index'));

        return view('users.index', $data);
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
        if (!User::hasAuthority('store.users')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'phone' => 'required|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = User::store([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'status' => $request->status,
            'type' => $request->type,
        ]);

        // Relations
        if ($resource){
            foreach ($request->input('roles') as $role){
                $resource->roles()->attach(Role::getBy('uuid', $role)->id);
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
     * Show user profile.
     */
    public function showUserProfile()
    {
        $data['user'] = User::getBy('id', auth()->user()->id);
        return view('users.profile.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['roles'] = Role::all();
        $data['user'] = User::getBy('uuid', $uuid);
        return response([
            'title'=> "Update user ' {$data['user']->name} '",
            'view'=> view('users.edit', $data)->render(),
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
        $resource = User::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $resource->id,
//            'phone' => 'required|max:20',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = User::edit([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => ($request->has('phone'))? $request->phone : '00',
            'status' => ($request->has('status'))? $request->status : $resource->status,
            'type' => ($request->has('type'))? $request->type : $resource->type,
//            'password' => (($request->has('password'))? bcrypt($request->password) : $resource->password),
            'updated_by' => auth()->user()->id
        ], $resource->id);

        // Relation
        if ($request->has('roles')){
            $resource->roles()->detach();

            foreach ($request->input('roles') as $role){
                $resource->roles()->attach(Role::getBy('uuid', $role)->id);
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
        $resource = User::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = User::remove($resource->id);

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
     * Availability
     */
    public function availability()
    {
        if(auth()->check()){
            if(auth()->user()->desk_id || auth()->user()->room_id){

                if(auth()->user()->available == 0){
                    // Will be 1
                    $data['message'] = [
                        'msg_status' => 1,
                        'text' => 'You are now available',
                        'btn_txt' => 'Go not available',
                    ];
                }else{
                    // Will be 0
                    $data['message'] = [
                        'msg_status' => 0,
                        'text' => 'You are now not available',
                        'btn_txt' => 'Go available',
                    ];
                }

                // Update user
                User::edit([
                    'available' => (auth()->user()->available == 0)? 1 : 0,
                ], auth()->user()->id);

                // Broadcast event
                if(auth()->user()->desk_id){
                    event(new DeskStatus(Desk::getBy('id', auth()->user()->desk_id)->uuid, (auth()->user()->available == 0)? 1 : 0));
                }

                if(auth()->user()->room_id){
                    event(new RoomStatus(Room::getBy('id', auth()->user()->room_id)->uuid, (auth()->user()->available == 0)? 1 : 0));
                }

                // Return
                return response()->json($data);
            }
        }
    }

    /**
     * Reset Password
     */
    public function resetPassword($user)
    {
        // Check permissions
//        if (!User::hasAuthority('index.user')){
//            return redirect('/');
//        }

        // Get Resource
        $resource = User::getBy('uuid', $user);

        if($resource){
            $resource->password = bcrypt(config('vars.default_password'));
            $resource->save();

            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Password Has been reset successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Sorry! User not exists.',
            ];
        }

        return back()->with('message', $data['message']);

    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request,$user)
    {
        // Check permissions
//        if (!User::hasAuthority('index.user')){
//            return redirect('/');
//        }

        // Get Resource
        $resource = User::getBy('uuid', $user);

        if($resource){
            $resource->password = bcrypt($request->password);
            $resource->save();

            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Password updated successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Sorry! User not exists.',
            ];
        }

        return back()->with('message', $data['message']);

    }
}
