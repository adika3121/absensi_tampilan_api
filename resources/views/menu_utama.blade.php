@extends('template.template')

@section('title')
  Menu Utama
@endsection

@section('content')
<section id="portfolio">
  <div class="container-fluid wow fadeInUp">

      <div class="section-header">
        <h3 class="section-title">Absensi Kelas</h3>
        <p class="section-description">Kampus Teknologi Informasi</p>
      </div>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li><a href="{{action('JadwalController@show', $hari="Senin")}}">Senin</a></li> <!--filter-active-->
              <li><a href="{{action('JadwalController@show', $hari="Selasa")}}">Selasa</a></li>
              <li><a href="{{action('JadwalController@show', $hari="Rabu")}}">Rabu</a></li>
              <li><a href="{{action('JadwalController@show', $hari="Kamis")}}">Kamis</a></li>
              <li><a href="{{action('JadwalController@show', $hari="Jumat")}}">Jumat</a></li>
            </ul>
          </div>
        </div>

        <div class="row" id="portfolio-wrapper">
          @foreach($data_jadwal as $jadwal)
          <div class="col-lg-3 col-md-6 portfolio-item filter-app">
            <a href="">
              <div class="details">
                <h4>{{$jadwal->kelas->nama}}</h4>
                  <span>Ruang {{$jadwal->ruangan->nama}}</span>
                  <p>{{$jadwal->kelas->dosen->nama}}</p>
              </div>
            </a>
          </div>
          @endforeach

          <!-- <div class="col-lg-3 col-md-6 portfolio-item filter-app">
            <a href="">
              <div class="details">
                <h4>Pemrograman Jaringan</h4>
                  <span>Ruang TI202</span>
                  <p>Arya Sasmita</p>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 portfolio-item filter-app">
            <a href="">
              <div class="details">
                <h4>Pemrograman Jaringan</h4>
                  <span>Ruang TI202</span>
                  <p>Arya Sasmita</p>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 portfolio-item filter-app">
            <a href="">
              <div class="details">
                <h4>Pemrograman Jaringan</h4>
                  <span>Ruang TI202</span>
                  <p>Arya Sasmita</p>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 portfolio-item filter-card">
            <a href="">
              <div class="details">
                <h4>Pemrograman Jaringan</h4>
                  <span>Ruang TI202</span>
                  <p>Arya Sasmita</p>
              </div>
            </a>
          </div> -->
        </div>
  </div>

<script type="text/javascript">
$("#portfolio-filters li a").click(function() {
    $(this).parent().addClass('filter-active').siblings().removeClass('filter-active');

    });
</script>
</section>


@endsection
