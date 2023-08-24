@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">入場QRコード</h2>
  <div>
    <div>{!! $qrCode !!}</div>
  </div>
</div>
@endsection