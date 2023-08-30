@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">入場QRコード</h2>
  <table class="">
    <tr>
      <th></th>
      <th>予約者名</th>
      <th>メールアドレス</th>
      <th>人数</th>
      <th>公演日</th>
    </tr>
    <tr>
      <td>
        @if($reservation->is_used)
        入場済み
        @else
        <form action="{{ route('entry', ['id' => $reservation->id]) }}" method="post">
          @csrf
          <button>入場</button>
        </form>
        @endif
      </td>
      <td>{{ $reservation->user->name }}</td>
      <td>{{ $reservation->user->email }}</td>
      <td>{{ $reservation->number }}</td>
      <td>{{ $reservation->date->start_date }}</td>
    </tr>
  </table>
</div>

@endsection