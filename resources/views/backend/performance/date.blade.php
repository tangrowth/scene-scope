@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">日付の変更</h2>
  @if (count($errors) > 0)
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
  @endif
  <table class="main__table create__table">
    <tr>
      <td>{{$dates->first()->start_date->format('Y/m/d H:i')}}</td>
      <form action="{{ route('date.update') }}" method="post">
        <td>
          @csrf
          <input type="hidden" name="id" value="{{ $dates->first()->id }}">
          <input type="number" name="capacity" value="{{ $dates->first()->capacity }}">席
        </td>
        <td><button class="btn">更新</button></td>
      </form>
      <td>
        <form action="{{ route('date.delete') }}" method="post">
          @csrf
          <input type="hidden" value="{{ $dates->first()->id }}" name="id">
          <button class="btn">削除</button>
        </form>
      </td>
    </tr>
    @foreach($dates->slice(1) as $date)
    <tr>
      <td>{{$date->start_date->format('Y/m/d H:i')}}</td>
      <form action="{{ route('date.update') }}" method="post">
        <td>
          @csrf
          <input type="hidden" name="id" value="{{ $date->id }}">
          <input type="number" name="capacity" value="{{ $date->capacity }}">席
        </td>
        <td><button class="btn">更新</button></td>
      </form>
      <td>
        <form action="{{ route('date.delete') }}" method="post">
          @csrf
          <input type="hidden" value="{{ $date->id }}" name="id">
          <button class="btn">削除</button>
        </form>
      </td>
    </tr>
    @endforeach
    <tbody id="dates_tbody">
    </tbody>
  </table>
  <button type="button" id="add_date" class="btn btn-primary">日付を追加する</button>
  <a href="{{ route('performance', ['id' => $performance->id]) }}"><button class="btn">完了</button></a>
  <script>
    var date_count = 1;
    var dates_tbody = document.getElementById("dates_tbody");

    document.getElementById("add_date").addEventListener("click", function() {
      date_count++;

      var new_tr = document.createElement("tr");
      new_tr.classList.add("date__list");
      new_tr.innerHTML = `
        <td colspan="3">
          <form id="date-form" action="{{ route('date.add') }}" method="POST">
            @csrf
            <input type="hidden" name="performance_id" value="{{ $performance->id }}">
          </form>
          <table class="main__table">
            <tr>
              <td><input form="date-form" type="datetime-local" name="start_date"></td>
              <td><input form="date-form" type="number" name="capacity">席</td>
              <td><button form="date-form" type="submit" class="btn">追加</button></td>
            </tr>
          </table>
        </td>
        <td>
          <button type="button" class="btn btn-danger delete-date">削除</button>
        </td>
        `;
      dates_tbody.appendChild(new_tr);
    });

    document.addEventListener('click', function(event) {
      if (event.target.classList.contains('delete-date')) {
        event.target.closest('tr').remove();
      }
    });
  </script>

  @endsection