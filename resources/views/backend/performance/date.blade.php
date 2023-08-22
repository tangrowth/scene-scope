@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">日付の変更</h2>
  <table>
    <tr>
      <td>{{$dates->first()->start_date->format('Y/m/d H:i')}}</td>
      <form action="{{ route('date.update') }}" method="post">
        <td>
          @csrf
          <input type="hidden" name="id" value="{{ $dates->first()->id }}">
          <input type="number" name="capacity" value="{{ $dates->first()->capacity }}">席
        </td>
        <td><button>更新</button></td>
      </form>
      <td>
        <form action="{{ route('date.delete') }}" method="post">
          @csrf
          <input type="hidden" value="{{ $dates->first()->id }}" name="id">
          <button>削除</button>
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
        <td><button>更新</button></td>
      </form>
      <td>
        <form action="{{ route('date.delete') }}" method="post">
          @csrf
          <input type="hidden" value="{{ $date->id }}" name="id">
          <button>削除</button>
        </form>
      </td>
    </tr>
    @endforeach
    <tbody id="dates_tbody">
    </tbody>
  </table>
  <button type="button" id="add_date" class="btn btn-primary">日付を追加する</button>
  <button>完了</button>
  <script>
    var date_count = 1;
    var dates_tbody = document.getElementById("dates_tbody");

    document.getElementById("add_date").addEventListener("click", function() {
      date_count++;

      var new_tr = document.createElement("tr");
      new_tr.innerHTML = `
          <td colspan="3">
            <form action="{{ route('date.add') }}" method="POST">
              @csrf
              <input type="hidden" name="performance_id" value="{{ $performance->id }}">
              <input type="datetime-local" name="start_date">
              <input type="number" name="capacity">席
              <button type="submit">追加</button>
            </form>
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