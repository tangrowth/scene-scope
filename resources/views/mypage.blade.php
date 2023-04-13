@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<h2 class="main-pf-title">マイページ</h2>
<div class="performances">
  <h3>予約している公演</h3>
  @if (@isset($reservations))
  <div class="reserve-cards">
    @foreach($reservations as $reservation)
    @include('common.reserve',['reservation'=>$reservation])
    @endforeach
  </div>
  @else
  <p>予約はありません</p>
  @endif
</div>
<div class="companies">
  <h2 class="main-com-title">お気に入りの劇団</h2>
  <div class=" com-cards">
    @include('common.company', ['companies' => $companies])
  </div>
</div>
<div class="performances">
  <h3>登録情報</h3>
  <table>
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