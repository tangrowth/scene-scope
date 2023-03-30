@extends('layouts.header')

@section('main')
<div class="performances">
  <h2 class="main-title">最新の公演</h2>
  @if (@isset($performances))
  @foreach($performances as $performance)
  @include('common.performance', ['performance'=>$performance])
  @endforeach
  @endif
</div>
<div class="companies">
  <h2>劇団</h2>
  @if (@isset($companies))
  @foreach ($companies as $company)
  <div class="company-card">
    <a href="{{ route('company' , [ 'id' => $company->id ]) }}">
      <div class="company-card-img"><img src="{{ $company->img_url }}" alt="画像なし"></div>
      <div class="company-cars-content">
        <p>{{ $company->name }}</p>
      </div>
    </a>
    @auth
    @endauth
  </div>
  @endforeach
  @endif
</div>
@endsection