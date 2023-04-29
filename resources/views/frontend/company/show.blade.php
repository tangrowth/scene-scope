@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<h2>{{ $company->name }}</h2>
<div class="company-info">
  <div class="company-info-img">
    @if($company->img_url)
    <img src="{{ asset($company->img_url) }}" alt="{{$company->title}}">
    @else
    <img src="{{ asset('storage/images/default.png') }}">
    @endif
  </div>
  <div class="company-info-content">
    <p>{{ $company->description }}</p>
    <a href="{{ $company->web_site_url }}">サイトはこちら</a>
  </div>
</div>
@endsection