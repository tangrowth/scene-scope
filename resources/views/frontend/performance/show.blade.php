@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBa0Dhuh6lv0cF52ndkqDw0PNsdBpXvIvM&callback=initMap"></script>
@endsection

@section('main')
<div class="container">
  <div>
    <h2 class="container-title">{{$performance->title}}</h2>
    <a href="{{ route('company', ['id' => $performance->company->id]) }}">{{ $performance->company->name }}</a>
  </div>
  @if($performance->img_url)
  <img src="{{ $performance->img_url }}" alt="{{$performance->title}}">
  @else
  <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png">
  @endif
</div>
<div class="container2">
  <div class="container3">
    <h3>あらすじ</h3>
    <p>{{$performance->description}}</p>
    <table>
      <tr>
        <th>会場</th>
        <td>{{ $performance->address }}</td>
      </tr>
      <tr>
        <th></th>
        <td>{{$performance->venue}}</td>
      </tr>
      <tr>
        <th>公演日</th>
        <td>{{$dates->first()->date->format('Y/m/d H:i')}}</td>
      </tr>
      @foreach($dates->slice(1) as $date)
      <tr>
        <th></th>
        <td>{{$date->date->format('Y/m/d H:i')}}</td>
      </tr>
      @endforeach
    </table>
    @can('admin')
    <div>
      <form action="{{ route('performance.delete') }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button>削除</button>
      </form>
    </div>
    <div>
      <form action="{{ route('performance.edit') }}">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button>編集</button>
      </form>
    </div>
    <div>
      <form action="{{ route('date.edit') }}">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button>公演日の変更</button>
      </form>
    </div>
    @endcan
    @can('owner')
    @if($performance->company_id == Auth::user()->company->id)
    <div>
      <form action="{{ route('performance.delete') }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button>削除</button>
      </form>
    </div>
    <div>
      <form action="{{ route('performance.edit') }}">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button>編集</button>
      </form>
    </div>
    <div>
      <form action="{{ route('date.edit') }}">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button>公演日の変更</button>
      </form>
    </div>
    @endif
    @endcan
  </div>
  <div class="container3">
    @auth
    <h3>予約</h3>
    @if($errors->any())
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
    @endif

    <form action="{{ route('reserve.confirm') }}" method="POST">
      @csrf
      <table>
        <tr>
          <th>申込み人数</th>
          <td><select name="number">
              <option value="1">1人</option>
              <option value="2">2人</option>
              <option value="3">3人</option>
              <option value="4">4人</option>
            </select></td>
        </tr>
        <tr>
          <th>公演日</th>
          <td>
            <select name="date_id" id="dateSelect">
              @foreach($performance->dates as $date)
              <option value="{{$date->id}}" data-capacity="{{ $date->capacity }}" data-reserved="{{ $date->reserved }}">{{$date->date->format('Y/m/d H:i')}}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr>
          <th>残席数</th>
          <td id="remainingSeats">{{ $performance->dates[0]->capacity - $performance->dates[0]->reserved }}</td>
        </tr>
      </table>
      <input type="hidden" name="performance_id" value="{{$performance->id}}">
      <input type="submit" class="main__btn" value="予約する">
    </form>
    <script>
      document.getElementById("dateSelect").addEventListener("change", function() {
        var selectedOption = this.options[this.selectedIndex];
        var capacity = parseInt(selectedOption.getAttribute("data-capacity"));
        var reserved = parseInt(selectedOption.getAttribute("data-reserved"));
        var remainingSeats = capacity - reserved;

        var remainingSeatsDiv = document.getElementById("remainingSeats");
        remainingSeatsDiv.textContent = remainingSeats;
      });

      function confirmCancel() {
        return window.confirm('予約をキャンセルしますか？');
      }
    </script>
    @if($reservations->count() > 0)
    <h3 style="padding-top: 20px;">予約内容</h3>
    <table>
      @foreach($reservations as $reservation)
      <tr>
        <td>{{ $reservation->date->date->format('Y/m/d H:i') }}</td>
        <td>{{ $reservation->number }}人</td>
        @if($reservation->is_canceled === null)
        <form action="{{ route('reserve.cancel') }}" method="post" onsubmit="return confirmCancel()">
          @csrf
          <input type="hidden" name="id" value="{{ $reservation->id }}">
          <td><button class="main__btn">キャンセル</button></td>
        </form>
        @else
        <td>キャンセル申請中</td>
        @endif
      </tr>
      @endforeach
    </table>
    @endif
    @endauth
    @guest
    <p>予約にはログインが必要です</p>
    <a href="../login">ログインはこちら</a>
    <a href="../register">新規登録はこちら</a>
    @endguest
  </div>
</div>
<!--
  <div>
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
    -->
@endsection