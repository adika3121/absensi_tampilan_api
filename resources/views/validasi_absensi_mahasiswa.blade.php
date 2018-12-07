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


  <div class="container">
    <div class="card-tb">
      <h3 class="text-center">{{$det_jadwal->nama_kelas}}</h3>
      <p class="text-center text-muted"> <span class="fa fa-user-circle mr-1"></span>{{$det_jadwal->nama_dosen}}</p>
      <h6 class="text-center"><span class="ruangan">{{$det_jadwal->nama_ruangan}}</span>{{$hari [$det_jadwal->hari]}}, {{$det_jadwal->mulai}}-{{$det_jadwal->selesai}} </h6>
      <div class="table-responsive">
        <table class="table table-bordered table-stripped">
          <thead>
            <tr>
              <th>NIM</th>
              <th>Nama Mahasiswa</th>
              <th>Waktu Absensi</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jadwal_dosen as $j_dsn)
              <tr>
                <td>{{$j_dsn->nim_mahasiswa}}</td>
                <td>{{$j_dsn->nama_mahasiswa}}</td>
                <td>{{$j_dsn->waktu_absensi}}</td>
                <td>{{ ($j_dsn->status == 1)? "Valid" : "Tidak Valid" }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
