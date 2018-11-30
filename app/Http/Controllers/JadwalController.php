<?php

namespace App\Http\Controllers;

use App\jadwal;
use Illuminate\Http\Request;
use App\ruangan;
use App\kelas;
use App\dosen;
use Faker\Generator;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data_jadwal = jadwal::with('ruangan','kelas')
                        // ->where('hari', $hari)
                        ->get();
        $data_kelas = kelas::with('dosen')->get();

        return view('menu_utama', compact('data_jadwal','data_kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show($hari)
    {

      $data_jadwal = jadwal::with('ruangan','kelas')
                      ->where('hari', $hari)
                      ->get();
      $data_kelas = kelas::with('dosen')->get();

      return view('data_utama', compact('data_jadwal','data_kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(jadwal $jadwal)
    {
        //
    }
}
