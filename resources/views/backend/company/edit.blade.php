@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">劇団の編集</h2>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  <form action="{{ route('company.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table class="main__table create__table">
      <input type="hidden" name="id" value="{{ $company->id }}">
      <tr>
        <th>劇団名</th>
        <td><input type="text" value="{{ $company->name }}" name="name"></td>
      </tr>
      <tr>
        <th>劇団説明</th>
        <td><textarea name="description" cols="30" rows="10">{{ $company->description }}</textarea></td>
      </tr>
      <tr>
        <th>公式サイト</th>
        <td><input type="text" name="web_site_url" value="{{ $company->web_site_url }}"></td>
      </tr>
      <tr>
        <th>画像</th>
        <td><input type="file" name="img_url"></td>
      </tr>
    </table>
    <button class="btn">更新する</button>
  </form>
</div>
@endsection