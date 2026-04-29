<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('members', App\Http\Controllers\memberController::class);
Route::resource('courts', App\Http\Controllers\courtController::class);

Route::delete('/bookings/{booking}','App\Http\Controllers\bookingController@destroy')->name('bookings.destroy')->middleware('permission:Delete Booking');
Route::delete('/members/{member}','App\Http\Controllers\memberController@destroy')->name('members.destroy')->middleware('permission:Delete Member');

Route::resource('bookings', App\Http\Controllers\bookingController::class);

Route::get('/loggedInMember','App\Http\Controllers\memberController@getLoggedInMemberDetails');

Route::group(['middleware' => ['role:System Admin']], function () {
    Route::resource('roles', App\Http\Controllers\rolesController::class);
    Route::resource('permissions', App\Http\Controllers\permissionsController::class);
    Route::resource('users', App\Http\Controllers\usersController::class);
});

Route::get('/users/assignroles/{id}', 'App\Http\Controllers\usersController@assignRoles')->name('users.assignroles');
Route::patch('/users/updateroles/{id}', 'App\Http\Controllers\usersController@updateRoles')->name('roles.rolesupdate');
Route::get('/roles/assignpermissions/{id}', 'App\Http\Controllers\rolesController@assignPermissions')->name('roles.assignpermissions');
Route::patch('/roles/updatepermissions/{id}', 'App\Http\Controllers\rolesController@updatePermissions')->name('roles.permissionsupdate');

Route::group(['middleware' => ['permission:Create New Member']], function () {
    Route::get('/members/create', 'App\Http\Controllers\memberController@create')->name('members.create');
    Route::post('/members/store', 'App\Http\Controllers\memberController@store')->name('members.store');
});

require __DIR__.'/auth.php';