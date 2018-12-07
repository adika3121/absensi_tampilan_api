<?php



Route::get("/", "PageController@index");
Route::get("/jadwal/kehadiran/{id}", "PageController@kehadiran");


Route::get("/login", function() {
   return view('auth.login');
 });

Route::get('/absensi', function () {
    return view('absensi_kelas');
});

Route::resource('/jadwal', 'JadwalController');


Route::post('/login/dosen', 'DosenController@login');

// Auth::routes();
//
// Route::get('/home', 'HomeController@index')->name('home');
