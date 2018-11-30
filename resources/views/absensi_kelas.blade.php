@extends('template.template')

@section('title')
  Absensi Kelas
@endsection

@section('content')
<section id="portfolio">
    <div class="container-fluid wow fadeInUp">
      <div class="section-header">
        <h3 class="section-title">Absensi Kelas</h3>
        <p class="section-description">Pemrograman Jaringan - Ruang TI202 - Arya Sasmita</p>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <table id="portfolio-flters" class="table table-bordered">
              <thead>
                <tr>
                  <th width="60">No</th>
                  <th width="150">NIM</th>
                  <th width="400">Nama Mahasiswa</th>
                  <th width="250">Waktu Absensi</th>
                  <th width="100">Status Validasi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>1605551034</td>
                  <td style="text-align:left">Natayasa</td>
                  <td>10 November 2018 20:21</td>
                  <td>Valid</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>1605551034</td>
                  <td>Natayasa</td>
                  <td>10 November 2018 20:21</td>
                  <td>Valid</td>
                </tr>
              </tbody>
          </table>
        </div>

      </div>
    </div>


</section>



@endsection
