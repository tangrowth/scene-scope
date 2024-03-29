@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">{{ $title }}</h2>
  <form action="{{ route('performance.search') }}" method="get">
    <input type="text" name="input" value="{{ $input }}" class="main__input">
    <button class="btn">検索</button>
  </form>
</div>
<div class="container">
  @include('common.performance', ['performances' => $performances])
  {{ $performances->links() }}
</div>

@endsection