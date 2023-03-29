@extends('layouts.header')

@section('main')
<h2>予約確認</h2>
<div>
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
        <td>{{$data['date']->date}}</td>
        <input type="hidden" value="{{$inputs['date_id']}}" name="date_id">
      </tr>
    </table>
    <input type="submit" value="内容を修正する" name="action">
    <input type="submit" value="申込みを確定する" name="action">
  </form>
</div>
@endsection