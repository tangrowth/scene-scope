@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">管理者メニュー</h2>
  <ul class="admin__menu">
    @can('admin')
    <li><a href="{{ route('admin.create') }}">劇団新規作成</a></li>
    @endcan
    @can('owner')
    <li><a href="{{ route('performance.create') }}">公演の作成</a></li>
    @endcan
    <li><a href="{{ route('reserve.menu') }}">予約の確認</a></li>
  </ul>
</div>
@can('owner')
<div class="container">
  <h2 class="container-title">劇団情報</h2>
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
      <form action="{{ route('company.edit') }}" method="get">
        @csrf
        <input type="hidden" value="{{ $company->id }}" name="id">
        <button class="btn">編集</button>
      </form>
    </div>
  </div>
</div>
<div class="container">
  <h2 class="container-title">作成した公演</h2>
  @include('common.performance', ['performances' => $performances])
</div>
@endcan
@endsection