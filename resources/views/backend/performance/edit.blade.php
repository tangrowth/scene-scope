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
      @if ($errors->has('title'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('title')}}
        </td>
      </tr>
      @endif
      <tr>
        <th>あらすじ</th>
        <td><textarea name="description" cols="30" rows="10">{{$performance->description}}</textarea></td>
      </tr>
      @if ($errors->has('description'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('description')}}
        </td>
      </tr>
      @endif
      <tr>
        <th>会場</th>
        <td><input type="text" name="venue" value="{{$performance->venue}}"></td>
      </tr>
      @if ($errors->has('venue'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('venue')}}
        </td>
      </tr>
      @endif
      <tr>
        <th>公式サイト</th>
        <td><input type="text" name="web_site_url" value="{{$performance->web_site_url}}"></td>
      </tr>
      @if ($errors->has('web_site_url'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('web_site_url')}}
        </td>
      </tr>
      @endif
    </table>

    <input type="submit" value="更新する">
  </form>
</div>
@endsection