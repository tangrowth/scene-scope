<div class="container-cards">
  @if (@isset($performances))
  @foreach($performances as $performance)
  <div class="container-card">
    <a href="{{ route('performance', ['id' => $performance->id]) }}">
      <div class="card-img">
        @if($performance->img_url)
        <img src="{{ asset($performance->img_url) }}" alt="{{$performance->title}}">
        @else
        <img src="{{ asset('storage/images/default.png') }}">
        @endif
      </div>
      <p class="pf-card-com">{{$performance->Company->name}}</p>
      <div class="pf-card-content">
        <div>
          <p>{{$performance->title}}</p>
          <p>{{$performance->venue}}</p>
        </div>
        <div>
          @can('admin')
          <div>
            <form action="{{ route('performance.delete') }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
              @csrf
              <input type="hidden" name="id" value="{{$performance->id}}">
              <button>削除</button>
            </form>
          </div>
          <div>
            <form action="{{ route('performance.edit') }}">
              @csrf
              <input type="hidden" name="id" value="{{$performance->id}}">
              <button>編集</button>
            </form>
          </div>
          @endcan
          @can('owner')
          @if($performance->company_id == Auth::user()->company->id)
          <div>
            <form action="{{ route('performance.delete') }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
              @csrf
              <input type="hidden" name="id" value="{{$performance->id}}">
              <button>削除</button>
            </form>
          </div>
          <div>
            <form action="{{ route('performance.edit') }}">
              @csrf
              <input type="hidden" name="id" value="{{$performance->id}}">
              <button>編集</button>
            </form>
          </div>
          @endif
          @endcan
        </div>
      </div>
    </a>
  </div>
  @endforeach
  @endif
</div>