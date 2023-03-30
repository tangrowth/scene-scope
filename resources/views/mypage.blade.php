@extends('layouts.header')

@section('main')
<h2 class="main-title">マイページ</h2>
<div class="reserve">
  <h3>予約している公演</h3>
  @if (@isset($reservations))
  <div class="reserve-list">
    @foreach($reservations as $reservation)
      @include('common.reserve',['reservation'=>$reservation])
    @endforeach
  </div>
  @else
  <p>予約はありません</p>
  @endif
</div>
<div class="favorite">
  <h3>お気に入りの劇団</h3>
  @if (@isset($favorites))
  <div class="company-list">
    @foreach($favorites as $favorite)
    <div class="company-card">
      <div class="company-card-img"><img src="{{ $favorite->company->img_url }}" alt="画像なし"></div>
      <div class="company-cars-content">
        <p>{{ $favorite->company->name }}</p>
        <p class="company-text">{{ Str::limit($favorite->company->description, 20) }}</p>
        <p class="company-full-text">{{ $favorite->company->description }}</p>
      </div>
    </div>
    @endforeach
  </div>
  @else
  <p>お気に入りはまだありません</p>
  @endif
</div>
<div class="prof">
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