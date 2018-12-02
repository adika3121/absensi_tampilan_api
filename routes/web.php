<?php


Route::get("/", "PageController@index");
Route::get("/jadwal/kehadiran/{id}", "PageController@kehadiran");

Route::get('/absensi', function () {
    return view('absensi_kelas');
});
// web
Route::resource('/jadwal', 'JadwalController');


Route::get('/login', 'DashboardController@login');