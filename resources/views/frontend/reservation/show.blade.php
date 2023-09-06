@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">予約情報</h2>
  <div class="reserve-img">
    @if($reservation->date->performance->img_url)
    <img src="{{ asset($reservation->date->performance->img_url) }}">
    @else
    <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png">
    @endif
  </div>
  <div>
    <a href="{{ route('performance', ['id' => $reservation->date->performance->id]) }}">
      <h2 class="reservation-title">{{ $reservation->date->performance->title }}</h2>
    </a>
      <table class="main__table">
        <tr>
          <th>主催</th>
          <td>{{$reservation->date->performance->company->name}}</td>
        </tr>
        <tr>
          <th>会場</th>
          <td>{{ $reservation->date->performance->venue }}</td>
        </tr>
        <tr>
          <th>時間</th>
          <td>{{ $reservation->date->start_date->format('Y/m/d H:i') }}</td>
        </tr>
        <tr>
          <th>席数</th>
          <td>{{ $reservation->number }}人</td>
        </tr>
      </table>
      <div class="card-buttons">
        @if($reservation->is_used == false)
        @if($reservation->is_canceled == false)
        <a href="{{ route('Qr.showQrCode', ['id'=>$reservation->id]) }}" class="btn">QR</a>
        <form action="{{ route('reserve.cancel') }}" method="post" onsubmit="return confirmCancel()">
          @csrf
          <input type="hidden" name="id" value="{{ $reservation->id }}">
          <button class="btn">キャンセル</button>
        </form>
        @else
        <p class="btn">キャンセル申請中</p>
        @endif
        @else
        ご来場ありがとうございました！
        @endif
      </div>
  </div>
</div>
<script>
  function confirmCancel() {
    return window.confirm('予約をキャンセルしますか？');
  }
</script>
@endsection