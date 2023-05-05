@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">入力確認</h2>
  <form action="{{ route('performance.store') }}" method="post">
    @csrf
    <table>
      <tr>
        <th>公演名</th>
        <td><input type="text" name="title" value="{{ $inputs['title'] }}" readonly></td>
      </tr>
      <tr>
        <th>あらすじ</th>
        <td><textarea name="description" cols="30" rows="10" readonly>{{ $inputs['description'] }}</textarea></td>
      </tr>
      <tr>
        <th>郵便番号</th>
        <td><input id="zip" type="text" name="zip" size="7" value="{{ $inputs['zip11'] }}" readonly></td>
      </tr>
      <tr>
        <th>住所</th>
        <td><input id="address" type="text" name="address" size="30" value="{{ $inputs['addr11'] }}"></td>
      </tr>
      <tr>
        <th>会場</th>
        <td><input type="text" name="venue" value="{{ $inputs['venue'] }}" readonly></td>
      </tr>
      <tr>
        <th>公式サイト</th>
        <td><input type="text" name="web_site_url" value="{{ $inputs['web_site_url'] }}" readonly></td>
      </tr>
      @foreach( $inputs['dates'] as $date)
      <tr>
        <th>公演日</th>
        <td><input type="date" name="dates[]" class="form-control" value="{{ $date }}" readonly></td>
      </tr>
      @endforeach
    </table>
    <input type="submit" value="内容を修正する" name="action">
    <input type="submit" value="公演を作成する" name="action">
  </form>
</div>
@endsection