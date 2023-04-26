@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">新規公演作成</h2>
  <form action="{{ route('performance.confirm') }}" method="post">
    @csrf
    <table>
      <tr>
        <th>公演名</th>
        <td><input type="text" name="title"></td>
      </tr>
      @if ($errors->has('title'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('title')}}
        </td>
      </tr>
      @endif
      <tr>
        <th>あらすじ</th>
        <td><textarea name="description" cols="30" rows="10"></textarea></td>
      </tr>
      @if ($errors->has('description'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('description')}}
        </td>
      </tr>
      @endif
      <tr>
        <th>会場</th>
        <td><input type="text" name="venue"></td>
      </tr>
      @if ($errors->has('venue'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('venue')}}
        </td>
      </tr>
      @endif
      <tr>
        <th>公式サイト</th>
        <td><input type="text" name="web_site_url"></td>
      </tr>
      @if ($errors->has('web_site_url'))
      <tr>
        <th style="background-color: red">ERROR</th>
        <td>
          {{$errors->first('web_site_url')}}
        </td>
      </tr>
      @endif
      <tbody id="dates_tbody">
        <tr>
          <th>公演日</th>
          <td><input type="date" name="dates[]" class="form-control" id="date1"></td>
        </tr>
      </tbody>
    </table>
    <button type="button" id="add_date" class="btn btn-primary">日付を追加する</button>
    <input type="submit" value="作成する">
  </form>
  <script>
    var date_count = 1;
    var dates_tbody = document.getElementById("dates_tbody");

    document.getElementById("add_date").addEventListener("click", function() {
      date_count++;

      var new_tr = document.createElement("tr");
      new_tr.innerHTML = `
        <th></th>
        <td><input type="date" name="dates[]" class="form-control" id="date${date_count}"></td>
      `;

      dates_tbody.appendChild(new_tr);
    });
  </script>
</div>
@endsection