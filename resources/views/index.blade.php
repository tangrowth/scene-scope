@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="performances">
  <h2 class="main-pf-title">最新の公演</h2>
  @include('common.performance', ['performances' => $performances])
  <a href="{{ route('performance.all') }}" class="pf-reservation-btn">公演をもっと見る</a>
</div>
<div class="companies">
  <h2 class="main-com-title">劇団</h2>
  <div class=" com-cards">
    @include('common.company', ['companies' => $companies])
  </div>
  <a href="{{ route('company.all') }}" class="pf-reservation-btn">劇団をもっと見る</a>
</div>
@endsection