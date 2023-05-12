@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">予約情報</h2>
  <table>
    <tr>
      <td>公演名</td>
      <td>予約件数</td>
      <td></td>
    </tr>
    @foreach($performances as $performance)
    <tr>
      <td>
        {{$performance->title}}
      </td>
      <td>
        {{ $performance->reservations_count }}件
      </td>
      <td>
        <form action="{{ route('reserve.show') }}" method="GET">
          @csrf
          <input type="hidden" name="performance_id" value="{{ $performance->id }}">
          <button type="submit">詳細を確認する</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection