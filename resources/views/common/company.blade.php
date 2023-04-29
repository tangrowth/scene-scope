<div class="container-cards">
  @if (isset($companies))
  @foreach ($companies as $company)
  <div class="container-card">
    <a href="{{ route('company' , [ 'id' => $company->id ]) }}">
      <div class="card-img">
        @if($company->img_url)
        <img src="{{ asset($company->img_url) }}" alt="{{$company->title}}">
        @else
        <img src="{{ asset('storage/images/default.png') }}">
        @endif
      </div>
      <div class="com-card-content">
        <p>{{ $company->name }}</p>
        @can('read')
        <div class="fav-btn">
          @if($favorites->contains('company_id', $company->id))
          <form action="{{ route('favorite.off', [ 'id' => $favorites->where('company_id', $company->id)->first()->id ]) }}" method="post">
            @csrf
            <button>
              <img src="{{ asset('storage/images/heart_on.png') }}" alt="お気に入り">
            </button>
          </form>
          @else
          <form action="{{ route('favorite.on') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $company->id }}" name="company_id">
            <button>
              <img src="{{ asset('storage/images/heart_off.png') }}" alt="お気に入り">
            </button>
          </form>
          @endif
        </div>
        @endcan
        @can('admin')
        <div>
          <form action="{{ route('company.delete') }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            <input type="hidden" value="{{ $company->id }}" name="id">
            <button class="delete-btn"><img src="{{ asset('storage/images/cross.png') }}"></button>
          </form>
        </div>
        @endcan
      </div>
    </a>
    @auth
    @endauth
  </div>
  @endforeach
  @endif
</div>