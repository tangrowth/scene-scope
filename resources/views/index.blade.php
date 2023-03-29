@extends('layouts.header')

@section('main')
<h2 class="main-title">最新の公演</h2>
<div class="pf">
  @if (@isset($performances))
  @foreach($performances as $performance)
  <div class="pf-card">
    <a href="{{ route('performance', ['id' => $performance->id]) }}">
      <div class="pf-img"><img src="{{$performance->img_url}}" alt="{{$performance->title}}"></div>
      <div class="pf-content">
        <p class="pf-title">{{$performance->title}}</p>
        <p class="pf-company">{{$performance->Company->name}}</p>
        <p class="pf-venue">{{$performance->venue}}</p>
      </div>
    </a>
  </div>
  @endforeach
  @endif
</div>
@endsection