@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">新規劇団作成</h2>

  <form action="{{ route('admin.user') }}" method="get">
    @csrf
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
    <table class="main__table">
      <tr>
        <th>劇団名</th>
        <td><input type="text" name="name" placeholder="" value="{{ old('name') }}"></td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td><input type="text" name="email" value="{{ old('email') }}"></td>
      </tr>
      <tr>
        <th>パスワード</th>
        <td><input type="password" name="password" placeholder="8文字以上で設定してください"></td>
      </tr>
      <tr>
        <th>確認用パスワード</th>
        <td><input type="password" name="password_confirmation" placeholder="同じパスワードを入力してください"></td>
      </tr>
    </table>
    <button class="btn">劇団作成に進む</button>
  </form>
</div>
@endsection