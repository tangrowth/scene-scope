@extends('layouts.header')

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