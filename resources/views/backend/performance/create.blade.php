@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">新規公演作成</h2>
  <form action="{{ route('performance.confirm') }}" method="post">
    @csrf
    <table>
      <tr>
        <th>公演名</th>
        <td><input type="text" name="title" value="{{ @old('title') }}"></td>
        @if ($errors->has('title'))
        <td>
          {{$errors->first('title')}}
        </td>
      </tr>
      @endif
      <tr>
        <th>あらすじ</th>
        <td><textarea name="description" cols="30" rows="10">{{ @old('description') }}</textarea></td>
        @if ($errors->has('description'))
        <td>
          {{$errors->first('description')}}
        </td>
        @endif
      </tr>
      <tr>
        <th>郵便番号</th>
        <td>
          <input type="text" name="zip11" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');">
        </td>
      </tr>
      <tr>
        <th>住所</th>
        <td>
          <input type="text" name="addr11" size="60">
        </td>
      </tr>

      <tr>
        <th>建物名</th>
        <td><input type="text" name="venue" value="{{ @old('venue') }}"></td>
        @if ($errors->has('venue'))
        <td>
          {{$errors->first('venue')}}
        </td>
        @endif
      </tr>
      <tr>
        <th>公式サイト</th>
        <td><input type="text" name="web_site_url" value="{{ @old('web_site_url') }}"></td>
        @if ($errors->has('web_site_url'))
        <td>
          {{$errors->first('web_site_url')}}
        </td>
        @endif
      </tr>
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