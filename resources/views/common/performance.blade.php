<div class="performances">
  <h2 class="main-pf-title">最新の公演</h2>
  <div class="pf-cards">
    @if (@isset($performances))
    @foreach($performances as $performance)
    <div class="pf-card">
      <a href="{{ route('performance', ['id' => $performance->id]) }}">
        <div class="pf-card-img"><img src="{{ asset('storage/'.$performance->img_url) }}" alt="画像なし">
        </div>
        <p class="pf-card-com">{{$performance->Company->name}}</p>
        <div class="pf-card-content">
          <p>{{$performance->title}}</p>
          <p>{{$performance->venue}}</p>
        </div>
      </a>
    </div>
    @endforeach
    @endif
  </div>
</div>