@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h3 class="container-title">予約している公演</h3>
  @if (@isset($reservations))
  <div class="container-cards">
    @foreach($reservations as $reservation)
    @include('common.reserve',['reservation'=>$reservation])
    @endforeach
  </div>
  @else
  <p>予約はありません</p>
  @endif
</div>
<div class="container">
  <h3 class="container-title">お気に入りの劇団</h2>
    <div class="container-cards">
      @include('common.company', ['companies' => $companies])
    </div>
</div>
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
</div>
@endsection