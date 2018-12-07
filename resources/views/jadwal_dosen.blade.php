@extends('layouts.temp')

@section('title')
  Jadwal DOSEN
@endsection


@section('content')

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">NFC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 text-center mt-10 mt-10">
          <h3>Jadwal {{$dosen->nama}}</h3>
        </div>
      </div>
      <div class="row">
        @foreach($dosen_jadwal as $j_dosen)
        <div class="col-lg-3 col-md-6 mt-20">
          <a href="{{action('JadwalController@edit', $j_dosen->id_jadwal)}}">
            <div class="card-tb">

            <div class="card-body">
                <h4>{{$j_dosen->nama_kelas}}</h4>
                <span>{{$j_dosen->nama_ruangan}}</span> <br>
                <span>{{$hari [$j_dosen->hari]}}</span>
                <p>{{$j_dosen->mulai}} sampai {{$j_dosen->selesai}}</p>
            </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
@endsection
