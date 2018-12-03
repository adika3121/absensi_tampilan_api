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

        // $data_jadwal = jadwal::with('ruangan','kelas')
        //                 // ->where('hari', $hari)
        //                 ->get();
        // $data_kelas = kelas::with('dosen')->get();
        //
        // return view('menu_utama', compact('data_jadwal','data_kelas'));
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
    public function edit($id_jadwal)
    {
        $jadwal_dosen = jadwal::where('id_jadwal', $id_jadwal)
                        ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id_kelas')
                        ->join('ruangan', 'jadwal.ruangan_id', '=', 'ruangan.id_ruangan')
                        ->join('kehadiran', 'jadwal.id_jadwal', '=', 'kehadiran.jadwal_id')
                        ->join('mahasiswa', 'kehadiran.mahasiswa_id', '=', 'mahasiswa.id_mhs')
                        ->select('kelas.nama as nama_kelas',
                                  'ruangan.nama as nama_ruangan',
                                  'mahasiswa.nama as nama_mahasiswa',
                                  'mahasiswa.nim as nim_mahasiswa',
                                  'kehadiran.status_valid')
                        ->get();
        return view('validasi_absensi_mahasiswa', compact('jadwal_dosen'));
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
