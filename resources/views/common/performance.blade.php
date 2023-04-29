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
        <p>{{$performance->title}}</p>
        <p>{{$performance->venue}}</p>
      </div>
      @can('admin_or_owner')
      <div>
        <form action="{{ route('performance.delete') }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
          @csrf
          <input type="hidden" name="id" value="{{$performance->id}}">
          <button>削除</button>
        </form>
      </div>
      @endcan
    </a>
  </div>
  @endforeach
  @endif
</div>