@extends('layouts.header')

@section('main')
<h2 class="main-title">マイページ</h2>
<div class="reserve">
  <h3>予約している公演</h3>
  @if (@isset($reservations))
  <div class="reserve-list">
    @foreach($reservations as $reservation)
    <div class="reserve-card">
      <div class="reserve-card-img"><img src="{{$reservation->performance->img_url}}" alt="画像なし"></div>
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
    </div>
    @endforeach
  </div>
  @else
  <p>予約はありません</p>
  @endif
</div>
<div class="favorite">
  <h3>お気に入りの劇団</h3>
  @if (@isset($favorites))
  <div class="company-list">
    @foreach($favorites as $favorite)
    <div class="company-card">
      <div class="company-card-img"><img src="{{ $favorite->company->img_url }}" alt="画像なし"></div>
      <div class="company-cars-content">
        <p>{{ $favorite->company->name }}</p>
        <p class="company-text">{{ Str::limit($favorite->company->description, 20) }}</p>
        <p class="company-full-text">{{ $favorite->company->description }}</p>
        <script>
          const companyText = document.querySelector('.company-text');
          const companyFullText = document.querySelector('.company-full-text');

          companyText.addEventListener('mouseover', function() {
            companyText.style.display = 'none';
            companyFullText.style.display = 'block';
          });

          companyFullText.addEventListener('mouseout', function() {
            companyFullText.style.display = 'none';
            companyText.style.display = 'block';
          });
        </script>

      </div>
    </div>
    @endforeach
  </div>
  @else
  <p>お気に入りはまだありません</p>
  @endif
</div>
<div class="prof">
  <h3>登録情報</h3>
  <table>
    <tr>
      <th>名前</th>
      <td>{{ $user->name }}</td>
    </tr>
    <tr>
      <th>メールアドレス</th>
      <td>{{ $user->email }}</td>
    </tr>
  </table>
</div>
@endsection