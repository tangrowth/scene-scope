@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">新規劇団作成</h2>
  <form action="{{ route('admin.user') }}" method="post">
    @csrf
    <table>
      <tr>
        <th>劇団名</th>
        <td><input type="text" name="name" placeholder=""></td>
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
        <th>メールアドレス</th>
        <td><input type="text" name="email"></td>
      </tr>
      @if ($errors->has('email'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('email')}}
        </td>
      </tr>
      @endif
      <tr>
        <th>パスワード</th>
        <td><input type="password" name="password" placeholder="8文字以上で設定してください"></td>
      </tr>
      @if ($errors->has('password'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('password')}}
        </td>
      </tr>
      @endif
      <tr>
        <th>確認用パスワード</th>
        <td><input type="password" name="password_confirmation" placeholder="同じパスワードを入力してください"></td>
      </tr>
    </table>
    <button>劇団作成に進む</button>
  </form>
</div>
@endsection