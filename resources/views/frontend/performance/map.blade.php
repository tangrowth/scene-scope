@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">会場案内</h2>
  <div>
    <div class="map__img">
      @if($performance->map_img_url)
      <img src="{{ $performance->map_img_url }}" alt="{{$performance->title}}">
      @endif
    </div>
    <div class="map__guide">
      <p>{{ $performance->routing_guide }}</p>
    </div>
    <div class="map_btns">
      @if($performance->company->user_id == Auth::id())
      <a href="{{ route('performance.map.edit', ['id'=>$performance->id]) }}" class="btn">編集</a>
      @endif
      <a href="{{ route('performance', ['id'=>$performance->id]) }}" class="btn">戻る</a>
    </div>
  </div>
</div>
@endsection