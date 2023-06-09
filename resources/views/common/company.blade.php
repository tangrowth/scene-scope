<div class="container-cards">
  @if (isset($companies))
  @foreach ($companies as $company)
  <div class="container-card">
    <a href="{{ route('company' , [ 'id' => $company->id ]) }}">
      <div class="card-img">
        @if($company->img_url)
        <img src="{{ asset($company->img_url) }}" alt="{{$company->title}}">
        @else
        <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png">
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
              <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/heart_on.png" alt="お気に入り">
            </button>
          </form>
          @else
          <form action="{{ route('favorite.on') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $company->id }}" name="company_id">
            <button>
              <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/heart_off.png" alt="お気に入り">
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
            <button class="delete-btn"><img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/cross.png"></button>
          </form>
        </div>
        <div>
          <form action="{{ route('company.edit') }}">
            @csrf
            <input type="hidden" name="id" value="{{$company->id}}">
            <button>編集</button>
          </form>
        </div>
        @endcan
        @can('owner')
        @if($company->id == Auth::user()->company->id)
        <div>
          <form action="{{ route('company.edit') }}">
            @csrf
            <input type="hidden" name="id" value="{{$company->id}}">
            <button>編集</button>
          </form>
        </div>
        @endif
        @endcan
      </div>
    </a>
  </div>
  @endforeach
  @endif
</div>