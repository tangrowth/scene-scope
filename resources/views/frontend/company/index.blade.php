@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">{{ $title }}</h2>
  <form action="{{ route('company.search') }}" method="get">
    <input type="text" name="input" value="{{ $input }}" class="main__input">
    <button class="main__btn">検索</button>
  </form>
</div>
<div class="container">
  @include('common.company', ['companies' => $companies])
  {{ $companies->links() }}
</div>
@endsection