@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <div>
    <h2 class="container-title">{{$performance->title}}</h2>
    <a href="{{ route('company', ['id' => $performance->company->id]) }}">{{ $performance->company->name }}</a>
  </div>
  <div class="pf__img">
    @if($performance->img_url)
    <img src="{{ $performance->top_img_url }}" alt="{{$performance->title}}">
    @else
    <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/default.png">
    @endif
  </div>
</div>
<div class="container2">
  <div class="container3">
    <h3>あらすじ</h3>
    <p>{{$performance->description}}</p>
    <table class="main__table">
      <tr>
        <th>会場</th>
        <td>{{ $performance->address }}</td>
      </tr>
      <tr>
        <th class="pf__table">
          @if(isset($performance->routing_guide))
          <a href="{{ route('performance.map', ['id'=>$performance->id]) }}" class="map__btn btn">
            <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/map.png" alt="">
          </a>
          @elseif($performance->company->user_id == Auth::id())
          <a href="{{ route('performance.map', ['id'=>$performance->id]) }}" class="map__btn btn">
            <img src="https://scene-scope.s3.ap-northeast-1.amazonaws.com/map.png" alt="">
          </a>
          @endif
        </th>
        <td class="pf__table">{{$performance->venue}}</td>
      </tr>
      <tr>
        <th>公演日</th>
        <td>{{$dates->first()->start_date->format('Y/m/d H:i')}}</td>
      </tr>
      @foreach($dates->slice(1) as $date)
      <tr>
        <th></th>
        <td>{{$date->start_date->format('Y/m/d H:i')}}</td>
      </tr>
      @endforeach
    </table>
    @can('admin')
    <div>
      <form action="{{ route('performance.delete') }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button class="btn">削除</button>
      </form>
    </div>
    <div>
      <form action="{{ route('performance.edit') }}">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button class="btn">編集</button>
      </form>
    </div>
    <div>
      <form action="{{ route('date.edit') }}">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button class="btn">公演日の変更</button>
      </form>
    </div>
    @endcan
    @can('owner')
    @if($performance->company_id == Auth::user()->company->id)
    <div class="button__list">
      <form action="{{ route('performance.delete') }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button class="btn">削除</button>
      </form>
      <form action="{{ route('performance.edit') }}">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button class="btn">編集</button>
      </form>
      <form action="{{ route('date.edit') }}">
        @csrf
        <input type="hidden" name="id" value="{{$performance->id}}">
        <button class="btn">公演日の変更</button>
      </form>
    </div>
    @endif
    @endcan
  </div>
  <div class="container3">
    <h3>予約</h3>
    @auth
    @if($errors->any())
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
    @endif
    <form action="{{ route('reserve.confirm') }}" method="POST">
      @csrf
      <table class="main__table">
        <tr>
          <th>申込み人数</th>
          <td><select name="number">
              <option value="1">1人</option>
              <option value="2">2人</option>
              <option value="3">3人</option>
              <option value="4">4人</option>
            </select></td>
        </tr>
        <tr>
          <th>公演日</th>
          <td>
            <select name="date_id" id="dateSelect">
              @foreach($dates as $date)
              <option value="{{$date->id}}" data-capacity="{{ $date->capacity }}" data-reserved="{{ $date->reserved }}">{{$date->start_date->format('Y/m/d H:i')}}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr>
          <th>残席数</th>
          <td id="remainingSeats">{{ $performance->dates[0]->capacity - $performance->dates[0]->reserved }}</td>
        </tr>
      </table>
      <input type="hidden" name="performance_id" value="{{$performance->id}}">
      <input type="submit" class="btn" value="予約する">
    </form>
    @if($reservations->count() > 0)
    <h3 style="padding-top: 20px;">予約内容</h3>
    <table class="main__table">
      @foreach($reservations as $reservation)
      <tr>
        <td>
          <a href="{{ route('reserve.details', ['uuid'=>$reservation->uuid]) }}">
            {{ $reservation->date->start_date->format('Y/m/d H:i') }}
          </a>
        </td>
        <td>{{ $reservation->number }}人</td>
        @if($reservation->is_used === 0)
        @if($reservation->is_canceled === 1)
        <td>キャンセル申請中</td>
        @else
        <form action="{{ route('reserve.cancel') }}" method="post" onsubmit="return confirmCancel()">
          @csrf
          <input type="hidden" name="id" value="{{ $reservation->id }}">
          <td><button class="btn">キャンセル</button></td>
        </form>
        @endif
        @else
        <td>来場済</td>
        @endif
      </tr>
      @endforeach
    </table>
    @endif
    @endauth
    @guest
    <p class="container-content">予約にはログインが必要です</p>
    <a href="../login" class="btn">ログイン</a>
    <a href="../register" class="btn">新規登録</a>
    @endguest
  </div>
</div>
<script>
  document.getElementById("dateSelect").addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    var capacity = parseInt(selectedOption.getAttribute("data-capacity"));
    var reserved = parseInt(selectedOption.getAttribute("data-reserved"));
    var remainingSeats = capacity - reserved;

    var remainingSeatsDiv = document.getElementById("remainingSeats");
    remainingSeatsDiv.textContent = remainingSeats;
  });

  function confirmCancel() {
    return window.confirm('予約をキャンセルしますか？');
  }
</script>
@endsection