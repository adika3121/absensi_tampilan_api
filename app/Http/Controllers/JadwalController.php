<?php

namespace App\Http\Controllers;

use App\jadwal;
use Illuminate\Http\Request;
use App\ruangan;
use App\kelas;
use App\dosen;
use Faker\Generator;
use App\mahasiswa;
use App\kehadiran;
use DB;
use Carbon\Carbon;

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

    public function edit(Request $request, $id_jadwal)
    {
      if(isset($request->pertemuanKe)) {
        $jadwal_dosen = jadwal::where([['id_jadwal', $id_jadwal],[DB::raw('DATE(kehadiran.created_at)'), $request->pertemuanKe]])
                        ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id_kelas')
                        ->join('ruangan', 'jadwal.ruangan_id', '=', 'ruangan.id_ruangan')
                        ->join('kehadiran', 'jadwal.id_jadwal', '=', 'kehadiran.jadwal_id')
                        ->join('mahasiswa', 'kehadiran.mahasiswa_id', '=', 'mahasiswa.id_mhs')
                        ->select( 'mahasiswa.nama as nama_mahasiswa',
                                  'mahasiswa.nim as nim_mahasiswa',
                                  'kehadiran.created_at as waktu_absensi',
                                  'kehadiran.status_valid as status')
                        ->get();
      }else{
        $jadwal_dosen = jadwal::where('id_jadwal', $id_jadwal)
                        ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id_kelas')
                        ->join('ruangan', 'jadwal.ruangan_id', '=', 'ruangan.id_ruangan')
                        ->join('kehadiran', 'jadwal.id_jadwal', '=', 'kehadiran.jadwal_id')
                        ->join('mahasiswa', 'kehadiran.mahasiswa_id', '=', 'mahasiswa.id_mhs')
                        ->whereDate('kehadiran.created_at', date('Y-m-d'))
                        ->select( 'mahasiswa.id_mhs',
                                    'mahasiswa.nama as nama_mahasiswa',
                                  'mahasiswa.nim as nim_mahasiswa',
                                  'kehadiran.created_at as waktu_absensi',
                                  'kehadiran.status_valid as status')
                        ->get();
      }



        $det_jadwal = jadwal::where('id_jadwal', $id_jadwal)
                    ->join('kelas', 'jadwal.kelas_id', '=', 'kelas.id_kelas')
                    ->join('dosen', 'kelas.dosen_id', '=', 'dosen.id_dosen')
                    ->join('ruangan', 'jadwal.ruangan_id', '=', 'ruangan.id_ruangan')
                    ->select('jadwal.id_jadwal','kelas.nama as nama_kelas',
                                'dosen.nama as nama_dosen',
                                'ruangan.nama as nama_ruangan',
                                'jadwal.hari',
                                'jadwal.mulai as mulai',
                                'jadwal.selesai as selesai')
                    ->first();

        $validJadwal = kehadiran::
            where('jadwal_id', $id_jadwal)
            ->whereNotNull('tgl_valid')
            ->whereDate('tgl_valid', date('Y-m-d'))
            ->get();

        $hari = $this->hari;

        return view('validasi_absensi_mahasiswa', compact('validJadwal','jadwal_dosen', 'det_jadwal', 'hari'));
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

          $tgl_jadwal = jadwal::where('id_jadwal', $id_jadwal)
                        ->join('kehadiran', 'jadwal.id_jadwal', '=', 'kehadiran.jadwal_id')
                        ->select('kehadiran.created_at as tanggal')
                        ->groupBy(DB::raw('DATE(kehadiran.created_at)'))
                        ->get();

          $hari = $this->hari;

        return view('validasi_absensi_mahasiswa', compact('jadwal_dosen', 'det_jadwal', 'hari', 'tgl_jadwal'));
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

    public function validateClass(Request $request){
        
        # validating all mhs
        
        if($request->has('valid')){
            foreach($request->valid as $mhsId){
                kehadiran::where([
                    'mahasiswa_id'  => $mhsId,
                    'jadwal_id' => $request->id_jadwal
                ])
                ->whereDate('kehadiran.created_at', date('Y-m-d'))
                ->update(['status_valid' => 1, 'tgl_valid' => date('Y-m-d H:i:s')]);
    
                #notif ortunya
            }
        }
        

        $hadir = kehadiran::where('jadwal_id', $request->id_jadwal)
            ->whereDate('created_at', date('Y-m-d'))
            ->get()->pluck('mahasiswa_id');

        #copying mhs that absen to this class
        $absenMhs = mahasiswa::
            join('mahasiswa_kelas', 'mahasiswa_kelas.mahasiswa_id', '=', 'mahasiswa.id_mhs')
            ->join('jadwal', 'jadwal.kelas_id', '=', 'mahasiswa_kelas.kelas_id')
            ->where('jadwal.id_jadwal', $request->id_jadwal)
            ->whereNotIn('mahasiswa.id_mhs', $hadir)
            ->get();
        
        $bolos = mahasiswa::
            join('mahasiswa_kelas', 'mahasiswa_kelas.mahasiswa_id', '=', 'mahasiswa.id_mhs')
            ->join('jadwal', 'jadwal.kelas_id', '=', 'mahasiswa_kelas.kelas_id')
            ->where('jadwal.id_jadwal', $request->id_jadwal)
            ->whereNotIn('mahasiswa.id_mhs', $request->valid)
            ->get();
        
        $toJadwal = [];
        foreach($absenMhs as $mhs){
            $data = [
                'mahasiswa_id'  => $mhs->id_mhs,
                'jadwal_id'     => $request->id_jadwal,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')    
            ];
            array_push($toJadwal, $data);
        }

        if(count($toJadwal) > 0){
            kehadiran::insert($toJadwal);
            #notif jika bolos
        }

        kehadiran::where('jadwal_id', $request->id_jadwal)
            ->whereDate('created_at', date('Y-m-d'))
            ->update(['tgl_valid' => date("Y-m-d H:i:s")]);

        return redirect()->back();
    }
}
