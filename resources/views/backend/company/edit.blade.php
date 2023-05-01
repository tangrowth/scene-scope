@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">劇団の編集</h2>
  <form action="{{ route('company.update') }}" method="post">
    @csrf
    <table>
      <input type="hidden" name="id" value="{{ $company->id }}">
      <tr>
        <th>劇団名</th>
        <td><input type="text" value="{{ $company->name }}" name="name"></td>
      </tr>
      @if ($errors->has('name'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('name')}}
        </td>
      </tr>
      @endif
      <tr>
        <th>劇団説明</th>
        <td><textarea name="description" cols="30" rows="10">{{ $company->description }}</textarea></td>
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
        <th>公式サイト</th>
        <td><input type="text" name="web_site_url" value="{{ $company->web_site_url }}"></td>
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
    <button>更新する</button>
  </form>
</div>
@endsection