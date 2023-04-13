@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="performance">
  <div class="pf-detail-card">
    <div class="pf-card-img"><img src="{{ asset('/storage/' . $performance->img_url) }}" alt="{{$performance->title}}"></div>
    <table class="pf-detail-info">
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
      <form action="{{ route('reserve.destroy',['id' => $reservation->id]) }}" method="post" onsubmit="return confirmCancel()">
        @csrf
        <button class="delete-btn"><img src="{{ asset('storage/img/cross.png') }}"></button>
      </form>
      <script>
        function confirmCancel() {
          return window.confirm('予約をキャンセルしますか？');
        }
      </script>
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
    </div>
    @endguest
  </div>
</div>
@endsection