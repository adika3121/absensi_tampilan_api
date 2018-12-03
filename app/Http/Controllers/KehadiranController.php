<?php

namespace App\Http\Controllers;

use App\kehadiran;
use Illuminate\Http\Request;
use Validator;
use App\mahasiswa;
use App\jadwal;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            "rfid" => "required|string",
            "ruangan_id" => "required|int"
        ], [
            "rfid.required" => "RF ID tidak boleh kosong",
            "ruangan_id.required" => "RF ID tidak boleh kosong"
		]);

        if ($validator->fails()) {
            return response()->json([
            	"status" => false,
            	"pesan" => $validator->errors()->first()
            ]);            
        }

        $mahasiswa = mahasiswa::with([
            "mahasiswa_kelas"
        ])->first();

        $daftar_jadwal = jadwal::where([
            "hari" => idate("w", time())
        ])
        ->get();

        $sudah_absen = false;
        $kehadiran = null;

        foreach($daftar_jadwal as $jadwal){
            foreach($mahasiswa->mahasiswa_kelas as $mahasiswa_kelas){
                //jika mahasiswa mempunyai kelas
                if($mahasiswa_kelas->kelas_id == $jadwal->kelas_id){
                    //mengecek kehadiran mahasiswa
                    $jml_kehadiran = kehadiran::where([
                        "mahasiswa_id" => $mahasiswa->mahasiswa_id,
                        "jadwal_id" => $jadwal->jadwal_id,
                        "status_valid" => 0
                    ])
                    ->count();
                    if($jml_kehadiran == 0){
                        $kehadiran = new kehadiran;
                        $kehadiran->mahasiswa_id = $mahasiswa->mahasiswa_id;
                        $kehadiran->jadwal_id = $jadwal->jadwal_id;
                        $kehadiran->status_valid = 0;
                        $kehadiran->save();
                        $sudah_absen = true;
                        break;
                    }
                }
            }
            if($sudah_absen){
                break;
            }
        }

        if($sudah_absen){
            return response()->json([
                "status" => true,
                "pesan" => "Absen berhasil",
                "kehadiran" => $kehadiran
            ]);
        } else {
            return response()->json([
                "status" => false,
                "pesan" => "Tidak terdapat kelas",
                "kehadiran" => $kehadiran
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return kehadiran::with("mahasiswa")
            ->where("status_valid", 0)
            ->orderBy("created_at", "desc")
            ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function edit(kehadiran $kehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kehadiran $kehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(kehadiran $kehadiran)
    {
        //
    }
}
