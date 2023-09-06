@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">最新の公演</h2>
  @include('common.performance', ['performances' => $performances])
  <a href="{{ route('performance.all') }}" class="btn">公演をもっと見る</a>
</div>
<div class="container">
  <h2 class="container-title">劇団</h2>
    @include('common.company', ['companies' => $companies])
  <a href="{{ route('company.all') }}" class="btn">劇団をもっと見る</a>
</div>
@endsection