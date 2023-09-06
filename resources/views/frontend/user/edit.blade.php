@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">登録情報変更</h2>
  <form action="{{ route('mypage.update') }}" method="POST">
    <table class="detail-table main__table">
      @csrf
      @method('PUT')
      <tr>
        <th>名前</th>
        <td>{{ $user->name }}</td>
        <td><input type="text" name="name" placeholder="{{ $user->name }}"></td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $user->email }}</td>
        <td><input type="text" name="email" placeholder="{{ $user->email }}"></td>
      </tr>
    </table>
    <button class="btn">更新する</button>
  </form>
</div>
@endsection