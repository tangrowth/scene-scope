@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <p>ご予約ありがとうございます！</p>
  <p>予約が完了しました</p>
  <p>予約は<a href="{{ route('mypage') }}">マイページ</a>よりご確認ください。</p>
  <a href="{{ route('home') }}">ホームに戻る</a>
</div>
@endsection