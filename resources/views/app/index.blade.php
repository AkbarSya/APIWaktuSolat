@extends('app.app')

@section('head')

@endsection

@section('script')
  <script type="text/javascript">
    var latitude;
    var longitude;
    var timestamp;
    var timezonestring;
    var country;
    var city;
    var tanggal;
    $.getJSON('http://ipinfo.io', function(data){
      console.log(data);
      tanggal = moment().format("dddd, MMMM Do YYYY");
      timestamp = moment().unix();
      latitude = data.loc.split(',')[0];
      longitude = data.loc.split(',')[1];
      timezonestring = moment.tz.guess();

      country = data.country;
      city = data.city;

      $("#tanggal").html(tanggal);
      $.getJSON('http://api.aladhan.com/timings/'+timestamp+'?latitude='+latitude+'&longitude='+longitude+'&timezonestring='+timezonestring, function(hasil){
        console.log(hasil);
        var fajrdiff = moment(hasil.data.date.readable + " " + hasil.data.timings.Fajr, "DD MMM YYYY HH:mm").fromNow();
        var dhuhrdiff = moment(hasil.data.date.readable + " " + hasil.data.timings.Dhuhr, "DD MMM YYYY HH:mm").fromNow();
        var asrdiff = moment(hasil.data.date.readable + " " + hasil.data.timings.Asr, "DD MMM YYYY HH:mm").fromNow();
        var maghribdiff = moment(hasil.data.date.readable + " " + hasil.data.timings.Maghrib, "DD MMM YYYY HH:mm").fromNow();
        var ishadiff = moment(hasil.data.date.readable + " " + hasil.data.timings.Isha, "DD MMM YYYY HH:mm").fromNow();

        $("#fajrdiff").html(fajrdiff);
        $("#dhuhrdiff").html(dhuhrdiff);
        $("#asrdiff").html(asrdiff);
        $("#maghribdiff").html(maghribdiff);
        $("#ishadiff").html(ishadiff);

        // $("#tempat").html(city + ", " + country);
        $("#waktuFajr").html(hasil.data.timings.Fajr);
        $("#waktuDhuhr").html(hasil.data.timings.Dhuhr);
        $("#waktuAsr").html(hasil.data.timings.Asr);
        $("#waktuMaghrib").html(hasil.data.timings.Maghrib);
        $("#waktuIsha").html(hasil.data.timings.Isha);
      });
    });
  </script>
@endsection

@section('content')
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center" style="color:#1b5e20">بسم الله الرحمن الرحيم</h1>
      <div class="row center">
        <h5 class="header col s12 light" id="tanggal" style="color:#66bb6a "></h5>
      </div>
      <div class="row center">
        <h5 class="header col s12 light" id="tempat"style="color:#66bb6a "></h5>
      </div>
      <div class="row center">
        <a href="{{ url('monthly') }}" id="download-button" class="btn-large waves-effect waves-light green darken-2">Lihat Versi Bulanan</a>
      </div>
      <br><br>

    </div>
  </div>

  <div class="container">
    <div class="section">
      <div class="row center-align">
        <div class="col s12 m3">
          <div class="card green darken-1">
            <div class="card-content white-text">
              <span class="card-title"><img src="/img/shbh.png" style="max-width:100px">Shubuh(فجر)</span>
              <p id="waktuFajr">
              </p>
            </div>
            <div class="card-action">
              <span class="white-text" id="fajrdiff"></span>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card green darken-1">
            <div class="card-content white-text">
              <span class="card-title"><img src="/img/zhur.png" style="max-width:100px"><p>Dzuhur(زهور)</span></p>
              <p id="waktuDhuhr">
              </p>
            </div>
            <div class="card-action">
              <span class="white-text" id="dhuhrdiff"></span>
            </div>
          </div>
        </div>
        <div class="col s12 m3">
          <div class="card green darken-1">
            <div class="card-content white-text">
              <span class="card-title"><img src="/img/ashr.png" style="max-width:100px">Ashar(العشار)</span>
              <p id="waktuAsr">
              </p>
            </div>
            <div class="card-action">
              <span class="white-text" id="asrdiff"></span>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card green darken-1">
            <div class="card-content white-text">
              <span class="card-title"><img src="/img/mgrhb.png" style="max-width:100px"><p>Maghrib(المغرب)</span></p>
              <p id="waktuMaghrib">
              </p>
            </div>
            <div class="card-action">
              <span class="white-text" id="maghribdiff"></span>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card green darken-1">
            <div class="card-content white-text">
              <span class="card-title"><img src="/img/isya.png" style="max-width:100px"><p>Isya(العشاء)</span></p>
              <p id="waktuIsha">
              </p>
            </div>
            <div class="card-action">
              <span class="white-text" id="ishadiff"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
