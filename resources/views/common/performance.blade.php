<div class="container-cards">
  @if (@isset($performances))
  @foreach($performances as $performance)
  <div class="container-card">
    <a href="{{ route('performance', ['id' => $performance->id]) }}">
      <div class="card-img"><img src="{{ asset('storage/'.$performance->img_url) }}" alt="画像なし">
      </div>
      <p class="pf-card-com">{{$performance->Company->name}}</p>
      <div class="pf-card-content">
        <p>{{$performance->title}}</p>
        <p>{{$performance->venue}}</p>
      </div>
      @can('owner')
      <div>
        <a href="/">hay</a>
      </div>
      @endcan
    </a>
  </div>
  @endforeach
  @endif
</div>