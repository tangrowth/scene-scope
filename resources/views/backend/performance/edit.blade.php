@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">公演情報変更</h2>
  <form action="{{ route('performance.update') }}" method="post">
    @csrf
    <table>
      <input type="hidden" name="id" value="{{$performance->id}}">
      <tr>
        <th>公演名</th>
        <td><input type="text" name="title" value="{{$performance->title}}"></td>
      </tr>
      <tr>
        <th>あらすじ</th>
        <td><textarea name="description" cols="30" rows="10">{{$performance->description}}</textarea></td>
      </tr>
      <tr>
        <th>住所</th>
        <td>
          <input type="text" name="address" size="60" value="{{$performance->address}}">
        </td>
      </tr>
      <tr>
        <th>建物名</th>
        <td><input type="text" name="venue" value="{{$performance->venue}}"></td>
      </tr>
      <tr>
        <th>公式サイト</th>
        <td><input type="text" name="web_site_url" value="{{$performance->web_site_url}}"></td>
      </tr>
    </table>
    <input type="submit" value="更新する">
  </form>
</div>
@endsection