@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
@include('common.performance', ['performances' => $performances])
<div class="companies">
  <h2 class="main-com-title">劇団</h2>
  <div class=" com-cards">
    @include('common.company', ['companies' => $companies])
  </div>
</div>
@endsection