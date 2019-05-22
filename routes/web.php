<?php

Route::group(
    ['middleware' => ['cors']
],function (){

});

//// Integration Section ////////
Route::get('/integration/get-clinics', 'SyncVendorDataController@getClientClinics');
Route::get('/integration/get-specialities', 'SyncVendorDataController@getClientSpecialities');
Route::get('/integration/get-patients', 'SyncVendorDataController@getClientPatients');
Route::get('/integration/get-doctors', 'SyncVendorDataController@getClientDoctors');
//// END Integration Section ////

Route::get('/reset', 'HomeController@resetReservations')->name('resetReservations');

Route::get('/test_oracle', 'SyncVendorDataController@getClientClinics');

Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index')->name('home');
Route::post('queues/{screen_uuid}/{floor_uuid}', 'DeskQueuesController@storeNewQueue')->name('desks.queues.storeNewQueue');

Auth::routes(['verify' => true]);
Route::get('logout', 'Auth\LoginController@logout');

Route::group([
    'prefix'=>'dashboard',
    'middleware' => ['auth']
],function (){
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::resource('permission-groups', 'PermissionGroupsController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('roles', 'RolesController');
    Route::resource('users', 'UsersController');
    Route::resource('floors', 'FloorsController');
    Route::resource('desks', 'DesksController');
    Route::resource('rooms', 'RoomsController');
    Route::resource('printers', 'PrintersController');
    Route::resource('screens', 'ScreensController')->except(['show']);
    
    // Desks Actions
    Route::get('desk/{desk_uuid}/{desk_queue_uuid}/skip', 'DeskQueuesController@skipQueueNumber')->name('desks.queues.skipQueueNumber');
    Route::get('desk/{desk_uuid}/{desk_queue_uuid}/skip-and-next', 'DeskQueuesController@skipAndNextQueueNumber')->name('desks.queues.skipAndNextQueueNumber');
    Route::get('desk/{desk_uuid}/{queue_uuid}/call-skipped', 'DeskQueuesController@callSkippedAgain')->name('desks.queues.callSkippedAgain');

    Route::get('desk/{desk_uuid}/next', 'DeskQueuesController@callNextQueueNumber')->name('desks.queues.callNextQueueNumber');
    Route::get('desk/{desk_uuid}/next-again', 'DeskQueuesController@callNextQueueNumberAgain')->name('desks.queues.callNextQueueNumberAgain');

    Route::get('desk/reservation/{reservation_serial}/check', 'DeskQueuesController@checkReservationSerial')->name('desks.queues.checkReservationSerial');

    Route::get('desk/{desk_uuid}/{desk_queue_uuid}/{reservation_serial}/done', 'DeskQueuesController@doneQueueNumber')->name('desks.queues.doneQueueNumber');
    Route::get('desk/{desk_uuid}/{desk_queue_uuid}/{reservation_serial}/done-and-next', 'DeskQueuesController@doneAndNextQueueNumber')->name('desks.queues.doneAndNextQueueNumber');

    // Rooms Actions
    Route::get('room/{room_uuid}/{room_queue_uuid}/skip', 'RoomQueuesController@skipQueueNumber')->name('rooms.queues.skipQueueNumber');
    Route::get('room/{room_uuid}/{room_queue_uuid}/skip-and-next', 'RoomQueuesController@skipAndNextQueueNumber')->name('rooms.queues.skipAndNextQueueNumber');
    Route::get('room/{room_uuid}/{queue_uuid}/call-skipped', 'RoomQueuesController@callSkippedAgain')->name('rooms.queues.callSkippedAgain');

    Route::get('room/{room_uuid}/next', 'RoomQueuesController@callNextQueueNumber')->name('rooms.queues.callNextQueueNumber');
    Route::get('room/{room_uuid}/next-again', 'RoomQueuesController@callNextQueueNumberAgain')->name('rooms.queues.callNextQueueNumberAgain');

    Route::get('room/{room_uuid}/{room_queue_uuid}/in', 'RoomQueuesController@inQueueNumber')->name('rooms.queues.inQueueNumber');

    Route::get('room/{room_uuid}/{room_queue_uuid}/out', 'RoomQueuesController@outQueueNumber')->name('rooms.queues.outQueueNumber');
    Route::get('room/{room_uuid}/{room_queue_uuid}/out-and-next', 'RoomQueuesController@outAndNextQueueNumber')->name('rooms.queues.outAndNextQueueNumber');


    // Desk History
    Route::get('desk/queues/history', 'DeskQueuesController@deskQueueHistory')->name('desks.queues.deskQueueHistory');
    Route::get('desk/queues/{queue_uuid}/history', 'DeskQueuesController@deskQueueSingleHistory')->name('desks.queues.deskQueueSingleHistory');

    // Room History
    Route::get('rooms/queues/history', 'RoomQueuesController@roomQueueHistory')->name('rooms.queues.roomQueueHistory');
    Route::get('rooms/queues/{queue_uuid}/history', 'RoomQueuesController@roomQueueSingleHistory')->name('rooms.queues.roomQueueSingleHistory');

    // Go available
    Route::get('user/availability', 'UsersController@availability')->name('users.availability');
});

Route::get('screens/{screen}', 'ScreensController@show')->name('screens.show');

Route::get('screens/ajax/{screen}/get-contents', 'ScreensController@getScreensAjaxContents')->name('screens.getScreensAjaxContents');

Route::get('get-my-ip', function(){
    return view('get_my_ip');
})->name('ip.get');
Route::get('mtm', function(){
    return view('mtm');
});