<div class="reserve-card">
  <div class="reserve-card-img"><img src="{{ asset('/storage/' . $reservation->performance->img_url) }}" alt="画像なし"></div>
  <div class="reserve-card-content">
    <a href="{{ route('performance', ['id' => $reservation->performance->id]) }}">{{ $reservation->Performance->title }}</a>
    <table>
      <tr>
        <th>劇団</th>
        <td>{{ $reservation->Performance->Company->name }}</td>
      </tr>
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
  </div>
  <button id="delete-btn"><img src="{{ asset('storage/img/cross.png') }}" alt=""></button>
</div>