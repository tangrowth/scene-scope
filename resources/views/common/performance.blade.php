<div class="container-cards">
  @if (@isset($performances))
  @foreach($performances as $performance)
  <div class="pf__card">
    <a href="{{ route('performance' , [ 'id' => $performance->id ]) }}">
      <div class="pf__card-main">
        @if($performance->img_url)
        <img src="{{ $performance->img_url }}" alt="">
        @else
        <img src="{{ asset('storage/images/default.png') }}" alt="">
        @endif
        <span>
          <h3>{{ $performance->title }}</h3>
          <p>{{$performance->Company->name}}</p>
        </span>
      </div>
      <?php
      $dates = $performance->dates->sortBy('start_date')->values()->all();
      ?>
      <div class="pf__card-date">
        <p>{{$dates[0]->start_date->format('Y/m/d')}}～{{$dates[count($dates) - 1]->start_date->format('Y/m/d')}}</p>
      </div>
    </a>
  </div>
  @endforeach
  @endif
</div>