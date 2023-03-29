@extends('layouts.header')

@section('main')
<h2 class="main-title">最新の公演</h2>
<div class="pf">
  @if (@isset($performances))
  @foreach($performances as $performance)
    @include('common.performance', ['performance'=>$performance])
  @endforeach
  @endif
</div>
@endsection