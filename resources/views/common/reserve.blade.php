@foreach($reservations as $reservation)
<div>
  <a href="{{ route('reserve.details', ['uuid'=>$reservation->uuid]) }}"  class="reserve-card">
    <div class="reserve-card-img">
      @if($reservation->date->performance->img_url)
      <img src="{{ asset($reservation->date->performance->img_url) }}">
      @else
      <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png">
      @endif
    </div>
    <div class="reserve-card-content">
      <h4>{{ $reservation->date->performance->title }}</h4>
      <div>
        <p>{{$reservation->date->performance->company->name}}</p>
        <p>{{ $reservation->date->performance->venue }}</p>
        <p>{{ $reservation->date->start_date->format('Y/m/d H:i') }}</p>
        <p>{{ $reservation->number }}人</p>
      </div>
    </div>
  </a>
</div>
<script>
  function confirmCancel() {
    return window.confirm('予約をキャンセルしますか？');
  }
</script>
@endforeach