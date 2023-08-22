@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">予約確認</h2>
  <form action="{{ route('reserve.store') }}" method="POST">
    @csrf
    <table>
      <tr>
        <th>公演</th>
        <td>{{$data['performance']->title}}</td>
        <input type="hidden" value="{{$inputs['performance_id']}}" name="performance_id">
      </tr>
      <tr>
        <th>予約人数</th>
        <td>{{$data['number']}}人</td>
        <input type="hidden" value="{{$inputs['number']}}" name="number">
      </tr>
      <tr>
        <th>日付</th>
        <td>{{$data['date']->start_date->format('Y/m/d H:i')}}</td>
        <input type="hidden" value="{{$inputs['date_id']}}" name="date_id">
      </tr>
    </table>
    <input type="submit" value="修正" name="action" class="main__btn">
    <input type="submit" value="確定" name="action" class="main__btn">
  </form>
</div>
@endsection