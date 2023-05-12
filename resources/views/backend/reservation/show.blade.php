@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">{{ $performance->title }}予約</h2>
  @foreach ($reservationsByDate as $dateId => $reservations)
  <h4>{{ $dates->find($dateId)->date }}</h4>
  <table>
    <thead>
      <tr>
        <th>予約者名</th>
        <th>席数</th>
        <th>メールアドレス</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($reservations as $reservation)
      <tr>
        <td>{{ $reservation->user->name }}</td>
        <td>{{ $reservation->number }}</td>
        <td>{{ $reservation->user->email }}</td>
        <td>
          <form action="{{ route('reserve.destroy',['id' => $reservation->id]) }}" method="post" onsubmit="return confirm('予約をキャンセルしますか？')">
            @csrf
            <button class="delete-btn"><img src="{{ asset('storage/images/cross.png') }}"></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endforeach
</div>
@endsection