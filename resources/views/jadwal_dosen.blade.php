@extends('dashboard.app')

@section('title')
  Jadwal DOSEN
@endsection


@section('content')

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 text-center mt-10">
          <h3>Jadwal {{$dosen->nama}}</h3>
        </div>
      </div>
      <div class="row">
        @foreach($dosen_jadwal as $j_dosen)
        <div class="col-lg-3 col-md-6 mt-20">
          <a href="{{action('JadwalController@edit', $j_dosen->id_jadwal)}}">
            <div class="card">
            </div>
            <div class="card-body">
                <h4>{{$j_dosen->nama_kelas}}</h4>
                <span>{{$j_dosen->nama_ruangan}}</span> <br>
                <span>{{$j_dosen->hari}}</span>
                <p>{{$j_dosen->mulai}} sampai {{$j_dosen->selesai}}</p>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
@endsection
