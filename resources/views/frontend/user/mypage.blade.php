@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h3 class="container-title">登録情報</h3>
  <table class="detail-table">
    <tr>
      <th>名前</th>
      <td>{{ $user->name }}</td>
    </tr>
    <tr>
      <th>メールアドレス</th>
      <td>{{ $user->email }}</td>
    </tr>
  </table>
  <a href="{{ route('mypage.edit') }}" class="main__btn">編集</a>
  <a href="{{ route('password.edit') }}" class="main__btn">パスワード編集</a>
</div>
<div class="container">
  <h2 class="container-title">チケット</h2>
  <h3>予約中</h3>
  <div class="reserve">
    @include('common.reserve', ['reservations' => $reservations])
  </div>
  <h3>入場済み</h3>
  <div class="reserve">
    @include('common.reserve', ['reservations' => $usedReservations])
  </div>
</div>
<div class="container">
  <h2 class="container-title">お気に入りの劇団</h2>
  @include('common.company', ['companies' => $companies])
</div>
@endsection