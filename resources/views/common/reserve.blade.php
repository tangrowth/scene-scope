@foreach($reservations as $reservation)
<div class="reserve-card">
  <div class="reserve-card-img">
    <a href="{{ route('performance', ['id' => $reservation->date->performance->id]) }}">
      @if($reservation->date->performance->img_url)
      <img src="{{ asset($reservation->date->performance->img_url) }}" alt="{{$reservation->performance->title}}">
      @else
      <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png">
      @endif
    </a>
  </div>
  <div class="reserve-card-content">
    <h4>{{ $reservation->date->performance->title }}</h4>
    <div>
      <p>{{$reservation->date->performance->company->name}}</p>
      <p>{{ $reservation->date->performance->venue }}</p>
      <p>{{ $reservation->date->date->format('Y/m/d H:i') }}</p>
      <p>{{ $reservation->number }}人</p>
    </div>
    <div class="card-buttons">
      <a href="" class="card-button">QR</a>
      @if($reservation->is_canceled === null)
      <form action="{{ route('reserve.cancel') }}" method="post" onsubmit="return confirmCancel()">
        @csrf
        <input type="hidden" name="id" value="{{ $reservation->id }}">
        <button class="main__btn">キャンセル</button>
      </form>
      @else
      <p class="card-button">キャンセル申請中</p>
      @endif
    </div>
  </div>
</div>
@endforeach