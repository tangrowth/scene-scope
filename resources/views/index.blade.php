@extends('layouts.header')

@section('main')
@include('common.performance', ['performances'=>$performances])
<div class="companies">
  <h2 class="main-com-title">劇団</h2>
  <div class=" com-cards">
    @if (@isset($companies))
    @foreach ($companies as $company)
    <div class="com-card">
      <a href="{{ route('company' , [ 'id' => $company->id ]) }}">
        <div class="com-card-img"><img src="{{ asset('storage/'.$company->img_url) }}" alt="画像なし"></div>
        <div class="com-card-content">
          <p>{{ $company->name }}</p>
        </div>
      </a>
      @auth
      @endauth
    </div>
    @endforeach
    @endif
  </div>
</div>
@endsection