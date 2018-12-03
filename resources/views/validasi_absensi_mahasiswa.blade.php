@extends('dashboard.app')

@section('title')
  Jadwal DOSEN
@endsection


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <table class="table">
          <thead>
            <tr>
              <th>Nama Kelas</th>
              <th>NIM</th>
              <th>Nama Mahasiswa</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jadwal_dosen as $j_dsn)
              <tr>
                <td>{{$j_dsn->nama_kelas}}</td>
                <td>{{$j_dsn->nim_mahasiswa}}</td>
                <td>{{$j_dsn->nama_mahasiswa}}</td>
                <td>{{ ($j_dsn->status == 1)? "Valid" : "Tidak Valid" }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
