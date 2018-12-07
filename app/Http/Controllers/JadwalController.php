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

     public $hari =  [
         1 => 'Senin',
         2 => 'Selasa',
         3 => 'Rabu',
         4 => 'Kamis',
         5 => 'Jumat',
         6 => 'Sabtu',
         7 => 'Minggu'
       ];

    public function edit($id_jadwal)
    {
        $jadwal_dosen = jadwal::where('id_jadwal', $id_jadwal)
                        ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id_kelas')
                        ->join('ruangan', 'jadwal.ruangan_id', '=', 'ruangan.id_ruangan')
                        ->join('kehadiran', 'jadwal.id_jadwal', '=', 'kehadiran.jadwal_id')
                        ->join('mahasiswa', 'kehadiran.mahasiswa_id', '=', 'mahasiswa.id_mhs')
                        ->select( 'mahasiswa.nama as nama_mahasiswa',
                                  'mahasiswa.nim as nim_mahasiswa',
                                  'kehadiran.created_at as waktu_absensi',
                                  'kehadiran.status_valid as status')
                        ->get();

          $det_jadwal = jadwal::where('id_jadwal', $id_jadwal)
                        ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id_kelas')
                        ->join('dosen', 'kelas.dosen_id', '=', 'dosen.id_dosen')
                        ->join('ruangan', 'jadwal.ruangan_id', '=', 'ruangan.id_ruangan')
                        ->select('kelas.nama as nama_kelas',
                                  'dosen.nama as nama_dosen',
                                  'ruangan.nama as nama_ruangan',
                                  'jadwal.hari',
                                  'jadwal.mulai as mulai',
                                  'jadwal.selesai as selesai')
                        ->first();
          $hari = $this->hari;

        return view('validasi_absensi_mahasiswa', compact('jadwal_dosen', 'det_jadwal', 'hari'));
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
