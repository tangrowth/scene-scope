@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">{{ $date->start_date->format('Y/m/d H:i') }}の予約</h2>
  <div class="">
    <form action="{{ route('reserve.search', ['id' => $date->id]) }}" method="get">
      <input type="text" name="input" class="search__input">
      <button class="btn">検索</button>
    </form>
  </div>
  <table class="reserve__list">
    <tr>
      <th></th>
      <th>予約者</th>
      <th>連絡先</th>
      <th>人数</th>
      <th></th>
      <th></th>
    </tr>
    @if($reservations->count() !== 0)
    @foreach($reservations as $reservation)
    <tr>
      <td>
        @if($reservation->is_used)
        入場済み
        @else
        <form action="{{ route('entry', ['id' => $reservation->id]) }}" method="post">
          @csrf
          <button class="reserve__btn">入場</button>
        </form>
        @endif
      </td>
      <td>{{ $reservation->user->name }}</td>
      <td>{{ $reservation->user->email }}</td>
      <td>{{ $reservation->number }}</td>
      <td>
        @if($reservation->is_canceled)
        キャンセル申請中
        @endif
      </td>
      <td>
        <form action="{{ route('reserve.delete') }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
          @csrf
          <input type="hidden" value="{{ $reservation->id }}" name="id">
          <button class="btn">キャンセル</button>
        </form>
      </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td colspan="5">予約はまだありません</td>
    </tr>
    @endif
  </table>
</div>
<script>
  function confirmCancel() {
    return window.confirm('予約をキャンセルしますか？');
  }
</script>
@endsection