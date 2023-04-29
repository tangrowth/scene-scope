@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">管理者メニュー</h2>
  <ul>
    <li><a href="{{ route('company.all') }}">劇団一覧</a></li>
    <li><a href="{{ route('performance.all') }}">公演一覧</a></li>
    @can('admin')
    <li><a href="{{ route('admin.create') }}">劇団新規作成</a></li>
    @endcan
    @can('owner')
    <li><a href="{{ route('performance.create') }}">公演の作成</a></li>
    @endcan
  </ul>
</div>
@can('owner')
<div class="container">
  <h2 class="container-title">作成した公演</h2>
  @include('common.performance', ['performances' => $performances])
</div>
@endcan
@endsection