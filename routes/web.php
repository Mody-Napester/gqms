<?php

Route::group(
    ['middleware' => ['cors']
],function (){

});

Route::get('/', 'HomeController@index')->name('home');
Route::post('queues/{screen_uuid}', 'DeskQueuesController@storeNewQueue')->name('desks.queues.storeNewQueue');

Auth::routes(['verify' => true]);

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
    Route::resource('screens', 'ScreensController');
    
    // Desks Actions
    Route::get('desk/{desk_uuid}/{desk_queue_uuid}/skip', 'DeskQueuesController@skipQueueNumber')->name('desks.queues.skipQueueNumber');
    Route::get('desk/{desk_uuid}/next', 'DeskQueuesController@callNextQueueNumber')->name('desks.queues.callNextQueueNumber');
    Route::get('desk/{desk_uuid}/{desk_queue_uuid}/done', 'DeskQueuesController@doneQueueNumber')->name('desks.queues.doneQueueNumber');
});

Route::get('get-my-ip', function(){
    return view('get_my_ip');
});
Route::get('mtm', function(){
    return view('mtm');
});