@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">入力確認</h2>
  <form action="{{ route('performance.store') }}" method="post">
    @csrf
    <table class="main__table create__table">
      <tr>
        <th>公演名</th>
        <td colspan="3"><input type="text" name="title" value="{{ $inputs['title'] }}" readonly></td>
      </tr>
      <tr>
        <th>画像</th>
        <td colspan="3">
          @if (isset($inputs['img_url']))
          <img src="{{ asset($inputs['img_url']) }}" style="width: 300px">
          <input type="hidden" name="img_url" value="{{ $inputs['img_url'] }}">
          @else
          <p>画像はありません</p>
          @endif
        </td>
      </tr>
      <tr>
        <th>あらすじ</th>
        <td colspan="3"><textarea name="description" cols="30" rows="10" readonly>{{ $inputs['description'] }}</textarea></td>
      </tr>
      <tr>
        <th>郵便番号</th>
        <td colspan="3"><input id="zip" type="text" name="zip" size="7" value="{{ $inputs['zip11'] }}" readonly></td>
      </tr>
      <tr>
        <th>住所</th>
        <td colspan="3"><input id="address" type="text" name="address" size="30" value="{{ $inputs['addr11'] }}"></td>
      </tr>
      <tr>
        <th>会場</th>
        <td colspan="3"><input type="text" name="venue" value="{{ $inputs['venue'] }}" readonly></td>
      </tr>
      <tr>
        <th>公式サイト</th>
        <td colspan="3"><input type="text" name="web_site_url" value="{{ $inputs['web_site_url'] }}" readonly></td>
      </tr>
      <tr>
        <th>公演日</th>
        <td><input type="text" name="dates[]" value="{{ \Carbon\Carbon::parse($dateCapacities[0]['date'])->format('Y/m/d H:i') }}" readonly></td>
        <td><input type="text" name="capacities[]" value="{{ $dateCapacities[0]['capacity'] }}" readonly><label for="">席</label></td>
      </tr>
      @foreach( array_slice($dateCapacities, 1) as $dateCapacity)
      <tr>
        <th></th>
        <td><input type="text" name="dates[]" value="{{ \Carbon\Carbon::parse($dateCapacity['date'])->format('Y/m/d H:i') }}" readonly></td>
        <td><input type="text" name="capacities[]" value="{{ $dateCapacity['capacity']}}" readonly><label for="">席</label></td>
      </tr>
      @endforeach
    </table>
    <input type="submit" value="内容を修正する" name="action" class="btn">
    <input type="submit" value="公演を作成する" name="action" class="btn">
  </form>
</div>
@endsection