<?php



Route::get("/", "PageController@index");
Route::get("/jadwal/kehadiran/{id}", "PageController@kehadiran");


Route::get("/login/dosen", function(){
  return view('auth.login');
});

Route::get('/absensi', function () {
    return view('absensi_kelas');
});

Route::resource('/jadwal', 'JadwalController');

Route::post('jadwal/validate', 'JadwalController@validateClass')->name('jadwal.validateClass');

Route::post('/login/dosen', 'DosenController@login');

// Auth::routes();
//
// Route::get('/home', 'HomeController@index')->name('home');
