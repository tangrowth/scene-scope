@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">会場案内</h2>
  <div>
    <form action="{{ route('performance.map.update') }}" method="post" enctype="multipart/form-data">
      @csrf
      <table class="main__table create__table">
        <input type="hidden" value="{{ $performance->id }}" name="id">
        <tr>
          <th>案内図</th>
          <td><input type="file" name="map_img_url"></td>
        </tr>
        <tr>
          <th>案内文</th>
          <td><textarea name="routing_guide" id="" cols="30" rows="10">{{ $performance->routing_guide }}</textarea></td>
        </tr>
      </table>
      <button class="btn">登録</button>
    </form>
  </div>
  @endsection