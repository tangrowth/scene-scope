<div class="pf-card">
  <a href="{{ route('performance', ['id' => $performance->id]) }}">
  <div class="pf-card-img">
    <img src="{{$performance->img_url}}" alt="画像はありません">
  </div>
  <div class="pfcard-cotent">
    <p class="pf-card-title">{{$performance->title}}</p>
    <p class="pf-card-com">{{$performance->Company->name}}</p>
    <p class="pf-card-venue">{{$performance->venue}}</p>
    </div>
  </a>
</div>