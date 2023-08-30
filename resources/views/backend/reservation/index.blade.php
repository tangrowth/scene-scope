@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">予約情報</h2>
  <table class="main__table">
    <tr>
      <th>公演名</th>
      <th></th>
      <th>予約件数</th>
      <td>キャンセル申請</td>
    </tr>
    @foreach($dates as $date)
    <tr>
      <td>
        <a href="/admin/reserve/list/{{ $date->id }}">
          {{ $date->performance->title }}
        </a>
      </td>
      <td>
        {{ $date->start_date->format('Y/m/d H:i') }}
      </td>
      <td>
        {{ $date->reserved }}件
      </td>
      <td>
        {{ $date->reservations ? $date->reservations->where('is_canceled', true)->count() : 0 }}件
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection