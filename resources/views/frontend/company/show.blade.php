@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-cp-title">
    @if($favorite === null)
    <form action="{{ route('favorite.on') }}" method="post">
      @csrf
      <input type="hidden" value="{{ $company->id }}" name="company_id">
      <button class="heart-btn"><img src="{{ asset('storage/images/heart_on.png') }}" alt=""></button>
    </form>
    @else
    <form action="{{ route('favorite.off', ['id' => $favorite->id]) }}" method="post">
      @csrf
      <input type="hidden" value="{{ $company->id }}" name="company_id">
      <button class="heart-btn"><img src="{{ asset('storage/images/heart_off.png') }}" alt=""></button>
    </form>
    @endif
    {{ $company->name }}
  </h2>
  <div class="company-info-img">
    @if($company->img_url)
    <img src="{{ asset($company->img_url) }}" alt="{{$company->title}}">
    @else
    <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png">
    @endif
  </div>
  <div class="container__text">
    <p>{{ $company->description }}</p>
  </div>
  <a href="{{ $company->web_site_url }}">公式サイトはこちら</a>
</div>
<div class="container">
  <h2 class="container-title">公演</h2>
  @include('common.performance', ['performances' => $performances])
</div>
@endsection