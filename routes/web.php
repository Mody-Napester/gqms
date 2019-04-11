<?php

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::group([
    'prefix'=>'dashboard',
    'middleware' => 'auth'
],function (){
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::resource('permission-groups', 'PermissionGroupsController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('roles', 'RolesController');
    Route::resource('users', 'UsersController');
    Route::resource('floors', 'FloorsController');
    Route::resource('desks', 'DesksController');
    Route::resource('screens', 'ScreensController');
});


Route::get('mtm', function(){
    return view('mtm');
});
