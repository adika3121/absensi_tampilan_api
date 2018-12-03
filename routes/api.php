<?php

use Illuminate\Http\Request;

Route::post('login/ortu', 'OrtuController@login');

Route::post('register', 'OrtuController@store');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource("absen","KehadiranController");
