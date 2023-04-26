@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">劇団</h2>
  <div class=" com-cards">
    @include('common.company', ['companies' => $companies])
  </div>
</div>
@endsection