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
  <div class="owner__cp">
    <div class="owner__cp-img">
      @if($company->img_url)
      <img src="{{ asset($company->img_url) }}" alt="{{$company->title}}">
      @else
      <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png">
      @endif
    </div>
    <div class="owner__cp-text">
      <p>{{ $company->description }}</p>
      <a href="{{ $company->web_site_url }}">公式サイトはこちら</a>
      @if($user_id === $company->user->id && $user_id !== null)
      <form action="{{ route('company.edit') }}" method="get">
        @csrf
        <input type="hidden" value="{{ $company->id }}" name="id">
        <button class="btn">編集</button>
      </form>
      @endif
    </div>
  </div>
</div>
<div class="container">
  <h2 class="container-title">公演</h2>
  @include('common.performance', ['performances' => $performances])
</div>
@endsection