@extends('layouts.header')

@section('main')
<p>ご予約ありがとうございます！</p>
<p>予約が完了しました</p>
<p>予約は<a href="{{ route('home') }}">マイページ</a>よりご確認ください。</p>
<a href="{{ route('home') }}">ホームに戻る</a>
@endsection