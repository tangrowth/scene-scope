@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">新規公演作成</h2>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  <form action="{{ route('performance.confirm') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table class="main__table create__table">
      <tr>
        <th>公演名</th>
        <td colspan="3"><input type="text" name="title" value="{{ old('title') }}"></td>
      </tr>
      <tr>
        <th>あらすじ</th>
        <td colspan="3"><textarea name="description" cols="30" rows="10">{{ @old('description') }}</textarea></td>
      </tr>
      <tr>
        <th>郵便番号</th>
        <td colspan="3">
          <input type="text" name="zip11" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');" value="{{ old('zip11') }}" placeholder="半角7文字 例：1234567">
        </td>
      </tr>
      <tr>
        <th>住所</th>
        <td colspan="3">
          <input type="text" name="addr11" value="{{ old('addr11') }}" placeholder="番地まで入力してください">
        </td>
      </tr>
      <tr>
        <th>会場名</th>
        <td colspan="3"><input type="text" name="venue" value="{{ old('venue') }}" placeholder=""></td>
      </tr>
      <tr>
        <th>公式サイト</th>
        <td colspan="3"><input type="text" name="web_site_url" value="{{ old('web_site_url') }}" placeholder="外部サイトがある場合は入力してください"></td>
      </tr>
      <tbody id="dates_tbody">
        <tr>
          <th>公演日</th>
          <td><input type="datetime-local" name="dates[]" class="form-control" id="date1"></td>
          <td><input type="number" name="capacities[]" value="{{ old('capacity') }}" placeholder="半角数字で入力"><label for="">席</label></td>
          <td><button type="button" class="btn btn-danger delete-date">削除する</button></td>
        </tr>
      </tbody>
      <tr>
        <th>トップ画像</th>
        <td colspan="3"><input type="file" name="top_img_url"></td>
      </tr>
      <tr>
        <th>チケット画像</th>
        <td colspan="3"><input type="file" name="img_url"></td>
      </tr>
    </table>
    <button type="button" id="add_date" class="btn btn-primary">日付を追加する</button>
    <input type="submit" value="作成する" class="btn">
  </form>
  <script>
    var date_count = 1;
    var dates_tbody = document.getElementById("dates_tbody");

    document.getElementById("add_date").addEventListener("click", function() {
      date_count++;

      var new_tr = document.createElement("tr");
      new_tr.innerHTML = `
      <th></th>
      <td>
      <input type="datetime-local" name="dates[]" class="form-control" id="date${date_count}"></td>
      <td><input type="number" name="capacities[]" value="{{ old('capacity') }}" placeholder="半角数字で入力"><label for="">席</label></td>
      <td><button type="button" class="btn btn-danger delete-date">削除する</button></td>
    `;
      new_tr.getElementsByTagName("th")[0].innerHTML = "";
      dates_tbody.appendChild(new_tr);
    });

    document.addEventListener('click', function(event) {
      if (event.target.classList.contains('delete-date')) {
        event.target.closest('tr').remove();
      }
    });
  </script>
</div>
@endsection