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
      @if ($errors->has('title'))
        <td>
          {{$errors->first('title')}}
        </td>
        @endif
      </tr>
      <tr>
        <th>あらすじ</th>
        <td><textarea name="description" cols="30" rows="10">{{$performance->description}}</textarea></td>
      @if ($errors->has('description'))
        <td>
          {{$errors->first('description')}}
        </td>
        @endif
      </tr>
      <tr>
        <th>会場</th>
        <td><input type="text" name="venue" value="{{$performance->venue}}"></td>
      @if ($errors->has('venue'))
        <td>
          {{$errors->first('venue')}}
        </td>
        @endif
      </tr>
      <tr>
        <th>公式サイト</th>
        <td><input type="text" name="web_site_url" value="{{$performance->web_site_url}}"></td>
      @if ($errors->has('web_site_url'))
        <td>
          {{$errors->first('web_site_url')}}
        </td>
        @endif
      </tr>
    </table>

    <input type="submit" value="更新する">
  </form>
</div>
@endsection