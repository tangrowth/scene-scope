@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">情報の確認</h2>
  <form action="{{ route('admin.company') }}" method="post">
    @csrf
    <table>
      <tr>
        <th>画像</th>
        <td>
          @if (isset($inputs['img_url']))
          <img src="{{ asset($inputs['img_url']) }}" style="width: 300px">
          <input type="hidden" name="img_url" value="{{ $inputs['img_url'] }}">
          @else
          <p>画像はありません</p>
          @endif
        </td>
      </tr>
      <tr>
        <th>劇団名</th>
        <td><input type="name" value="{{ $inputs['name'] }}" name="name" readonly></td>
      </tr>
      <tr>
        <th>劇団説明</th>
        <td><textarea name="description" cols="30" rows="10" readonly>{{ $inputs['description'] }}</textarea></td>
      </tr>
      <tr>
        <th>公式サイト</th>
        <td><input type="text" name="web_site_url" value="{{ $inputs['web_site_url'] }}" readonly></td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td><input type="text" name="email" value="{{ $inputs['email'] }}" readonly></td>
      </tr>
      <tr>
        <th>パスワード</th>
        <td><input type="text" name="password" value="{{ $inputs['password'] }}" readonly></td>
      </tr>
    </table>
    <input type="submit" value="キャンセル" name="action">
    <input type="submit" value="劇団を作成する" name="action">
  </form>
</div>
@endsection