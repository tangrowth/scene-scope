@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">管理者メニュー</h2>
  <ul>
    <li><a href="/">劇団一覧</a></li>
    <li><a href="/">公演一覧</a></li>
    <li><a href="{{ route('admin.create') }}">新規作成</a></li>
  </ul>
</div>
@endsection