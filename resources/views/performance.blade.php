@extends('layouts.header')

@section('main')
<h2 class="main-title">{{$performance->title}}</h2>
<div class="performance">
  <div class="pf-detail">
    <div class="pf-detail-img"><img src="{{$performance->img_url}}" alt="{{$performance->title}}"></div>
    <div class="pf--detail-content">
      <p class="pf-detail-title">{{$performance->title}}</p>
      <p class="pf-detail-company">{{$performance->Company->name}}</p>
      <p class="pf-detail-des">{{$performance->description}}</p>
      <p class="pf-detail-venue">{{$performance->venue}}</p>
      @foreach($performance->dates as $date)
      <p class="pf-detail-date">{{$date->date}}</p>
      @endforeach
    </div>
  </div>
  @auth
  @if($reservation)
  <div class="pf-reservation">
    <p>予約情報</p>
    @include('common.reserve', ['$reservation'=>$reservation])
  </div>
  @else
  <div class="pf-reservation">
    <p>公演予約</p>
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
          <th>公演日を入力してください</th>
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
      <input type="submit">
    </form>
  </div>
  @endif
  @endauth
  @guest
  <p>予約にはログインが必要です</p>
  <a href="/login">ログインはこちら</a>
  <a href="../register">新規登録はこちら</a>
  @endguest
</div>
@endsection