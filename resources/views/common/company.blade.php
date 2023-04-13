@if (isset($companies))
@foreach ($companies as $company)
<div class="com-card">
  <a href="{{ route('company' , [ 'id' => $company->id ]) }}">
    <div class="com-card-img"><img src="{{ asset('storage/'.$company->img_url) }}" alt="画像なし"></div>
    <div class="com-card-content">
      <p>{{ $company->name }}</p>
      @auth
      <div class="fav-btn">
        @if($favorites->contains('company_id', $company->id))
        <form action="{{ route('favorite.off', [ 'id' => $favorites->where('company_id', $company->id)->first()->id ]) }}" method="post">
          @csrf
          <button>
            <img src="{{ asset('storage/img/heart_on.png') }}" alt="お気に入り">
          </button>
        </form>
        @else
        <form action="{{ route('favorite.on') }}" method="post">
          @csrf
          <input type="hidden" value="{{ $company->id }}" name="company_id">
          <button>
            <img src="{{ asset('storage/img/heart_off.png') }}" alt="お気に入り">
          </button>
        </form>
        @endif
      </div>
      @endauth
    </div>
  </a>
  @auth
  @endauth
</div>
@endforeach
@endif