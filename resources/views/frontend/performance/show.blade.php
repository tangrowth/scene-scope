@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBa0Dhuh6lv0cF52ndkqDw0PNsdBpXvIvM&callback=initMap"></script>
@endsection

@section('main')
<div class="performance">
  <div class="card-detail">
    <div class="card-img">
      @if($performance->img_url)
      <img src="{{ asset($performance->img_url) }}" alt="{{$performance->title}}">
      @else
      <img src="{{ asset('storage/images/default.png') }}">
      @endif
    </div>
    <table class="detail-table">
      <tr>
        <th>タイトル</th>
        <td>{{$performance->title}}</td>
      </tr>
      <tr>
        <th>劇団</th>
        <td>{{$performance->Company->name}}</td>
      </tr>
      <tr>
        <th>あらすじ</th>
        <td>{{$performance->description}}</td>
      </tr>
      <tr>
        <th>会場</th>
        <td>{{ $performance->address }}</td>
      </tr>
      <tr>
        <th></th>
        <td>{{$performance->venue}}</td>
      </tr>
      @if (@isset($performance->dates))
      <tr>
        <th>公演日</th>
        <td>{{$performance->dates->first()->date}}</td>
      </tr>
      @foreach($performance->dates->slice(1) as $date)
      <tr>
        <th></th>
        <td>{{$date->date}}</td>
      </tr>
      @endforeach
      @endif
    </table>
  </div>
  <div class="pf-reservation">
    <div class="pf-reservation-map">
      <div id="map" class="map"></div>
      <script type="text/javascript">
        function initMap() {
          const geocoder = new google.maps.Geocoder();
          geocoder.geocode({
            address: '{{ $performance->address }}'
          }, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
              const latlng = {
                lat: results[0].geometry.location.lat(),
                lng: results[0].geometry.location.lng()
              };
              const opts = {
                zoom: 15,
                center: latlng
              };
              const map = new google.maps.Map(document.getElementById('map'), opts);
              new google.maps.Marker({
                position: latlng,
                map: map
              });
            } else {
              console.error('Geocode was not successful for the following reason: ' + status);
            }
          });
        }
        google.maps.event.addDomListener(window, 'load', initMap);
      </script>
    </div>
    <div class="pf-reservation-detail">
      @auth
      @if($reservations)
      <p class="pf-reservation-title">予約情報</p>
      @foreach ($reservations as $reservation)
      <table>
        <tr>
          <th>公演日</th>
          <td>{{ $reservation->Date->date }}</td>
        </tr>
        <tr>
          <th>予約人数</th>
          <td>{{ $reservation->number }}人</td>
        </tr>
      </table>
      <form action="{{ route('reserve.destroy',['id' => $reservation->id]) }}" method="post" onsubmit="return confirm('予約をキャンセルしますか？')">
        @csrf
        <button class="delete-btn"><img src="{{ asset('storage/images/cross.png') }}"></button>
      </form>
      @endforeach
      @endif
      <p class="pf-reservation-title">公演予約</p>
      <form action="{{ route('reserve.confirm') }}" method="POST">
        @csrf
        <table>
          <tr>
            <th>申込み人数</th>
            <td><select name="number">
                <option value="1">1人</option>
                <option value="2">2人</option>
                <option value="3">3人</option>
              </select></td>
          </tr>
          <tr>
            <th>公演日</th>
            <td>
              <select name="date_id">
                @foreach($performance->dates as $date)
                <option value="{{$date->id}}">{{$date->date}}</option>
                @endforeach
              </select>
            </td>
          </tr>
        </table>
        <input type="hidden" name="performance_id" value="{{$performance->id}}">
        <input type="submit" class="pf-reservation-btn">
      </form>
      @endauth
      @guest
      <p class="pf-reservation-title">予約にはログインが必要です</p>
      <a href="../login">ログインはこちら</a>
      <a href="../register">新規登録はこちら</a>
      @endguest
    </div>
  </div>
</div>
@endsection