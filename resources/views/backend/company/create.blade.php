@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">劇団の情報</h2>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  <form action="{{ route('admin.confirm') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table class="main__table create__table">
      <tr>
        <th>劇団名</th>
        <td><input type="name" value="{{ $user['name'] }}" name="name" readonly></td>
      </tr>
      <tr>
        <th>劇団説明</th>
        <td><textarea name="description" cols="30" rows="10">{{ old('description') }}</textarea></td>
      </tr>
      <tr>
        <th>公式サイト</th>
        <td><input type="text" name="web_site_url" value="{{ old('web_site_url') }}"></td>
      </tr>
      <tr>
        <th>劇団トップ画像</th>
        <td><input type="file" name="img_url" value="{{ old('imig_url') }}"></td>
      </tr>
    </table>
    <input type="hidden" name="email" value="{{ $user['email'] }}">
    <input type="hidden" name="password" value="{{ $user['password'] }}">
    <button class="btn">確認画面に進む</button>
  </form>
</div>
@endsection