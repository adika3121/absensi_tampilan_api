<?php

namespace App\Http\Controllers;

use App\ortu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;

class OrtuController extends Controller
{
  public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function login(Request $request){

        $usr = $request->username;
        $pass = $request->password;
        $ortu = ortu::where('username', $usr)
          ->selectRaw('id_ortu, nama, username, password, token')
          ->first();


        if (Hash::check($pass, $ortu->password)) {
          if ($ortu->token == null) {
            $ortu->token = uniqid();
            $ortu->save();
          }

          return response()->json([
            'status'  => true,
            'message' => 'User terotentifikasi',
            'ortu'  => $ortu
          ]);
        }

        return response()->json([
          'status'  => false,
          'msg'     => 'Salah kombinasi password dan username'
        ]);
    }

    public function riwayatMahasiswa($id_ortu){
      

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
              'nama' => 'required',
              'ortu' => 'required|unique:ortu',
              'password' => 'required'
          ]);

      if ($validator->fails()) {
              return response()->json(['error'=>$validator->errors()], 401);
        }
      $input = $request->all();
      $userOrtu = ortu::create($input);

      return response()->json([$userOrtu]);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function show(ortu $ortu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function edit(ortu $ortu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ortu $ortu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function destroy(ortu $ortu)
    {
        //
    }
}
