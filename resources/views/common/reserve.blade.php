<div class="reserve-card">
  <a href="{{ route('performance', ['id' => $reservation->performance->id]) }}">
    <div class="card-img">
      @if($reservation->performance->img_url)
      <img src="{{ asset($reservation->performance->img_url) }}" alt="{{$reservation->performance->title}}">
      @else
      <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png">
      @endif
    </div>
    <div class="reserve-card-content">
      <p class="pf-card-com">{{$reservation->performance->company->name}}</p>
      <table class="pf-detail-info">
        <tr>
          <th>会場</th>
          <td>{{ $reservation->Performance->venue }}</td>
        </tr>
        <tr>
          <th>公演日</th>
          <td>{{ $reservation->Date->date }}</td>
        </tr>
        <tr>
          <th>予約人数</th>
          <td>{{ $reservation->number }}人</td>
        </tr>
      </table>
  </a>
</div>
<form action="{{ route('reserve.destroy',['id' => $reservation->id]) }}" method="post" onsubmit="return confirmCancel()">
  @csrf
  <button class="delete-btn"><img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/cross.png"></button>
</form>
<script>
  function confirmCancel() {
    return window.confirm('予約をキャンセルしますか？');
  }
</script>
</div>