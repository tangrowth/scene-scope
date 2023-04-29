@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">登録情報変更</h2>
  <form action="/user/password" method="POST">
    <table class="detail-table">
      @csrf
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
      <tr>
        <th>今のパスワード</th>
        <td><input type="password" name="current_password"></td>
      </tr>
      <tr>
        <th>新しいパスワード</th>
        <td><input type="password" name="new_password"></td>
      </tr>
      <tr>
        <th>確認</th>
        <td><input type="password" placeholder="パスワードをもう一度入力してください" name="new_password_confirmation"></td>
      </tr>
    </table>
    <button>更新する</button>
  </form>
</div>
@endsection