<div class="container-cards">
  @if (isset($companies))
  @foreach ($companies as $company)
  <div class="cp__card">
    <a href="{{ route('company' , [ 'id' => $company->id ]) }}">
      <div class="cp__card-main">
        @if($company->img_url)
        <img src="{{ $company->img_url }}" alt="">
        @else
        <img src="{{ asset('storage/images/default.png') }}" alt="">
        @endif
        <span>
          <h3>{{ $company->name }}</h3>
        </span>
      </div>
    </a>
  </div>
  @endforeach
  @endif
</div>