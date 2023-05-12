@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
<div class="container">
  <h2 class="container-title">日付の変更</h2>
  <table>
    <tr>
      <td>{{$performance->dates->first()->date->format('Y/m/d H:i')}}</td>
      <td>
        <form action="{{ route('date.delete') }}" method="post">
          @csrf
          <input type="hidden" value="{{ $performance->dates->first()->id }}" name="id">
          <button>削除</button>
        </form>
      </td>
    </tr>
    @foreach($performance->dates->slice(1) as $date)
    <tr>
      <td>{{$date->date->format('Y/m/d H:i')}}</td>
      <td>
        <form action="{{ route('date.delete') }}" method="post">
          @csrf
          <input type="hidden" value="{{ $date->id }}" name="id">
          <button>削除</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
    <form action="{{ route('date.add') }}" method="POST">
      @csrf
      <table class="table">
        <tbody id="dates_tbody">
          <tr>
            <td>
              <input type="datetime-local" name="dates[]" multiple>
            </td>
            <td>
              <input type="hidden" name="performance_id[]" value="{{ $performance->id }}" multiple>
              <button type="button" class="btn btn-danger delete-date">削除</button>
            </td>
          </tr>
        </tbody>
      </table>
      <button type="button" id="add_date" class="btn btn-primary">日付を追加する</button>
      <input type="submit" value="更新する">
    </form>
    <script>
      var date_count = 1;
      var dates_tbody = document.getElementById("dates_tbody");

      document.getElementById("add_date").addEventListener("click", function() {
        date_count++;

        var new_tr = document.createElement("tr");
        new_tr.innerHTML = `
          <td>
            <input type="datetime-local" name="dates[]" multiple>
          </td>
          <td>
            <input type="hidden" name="performance_id[]" value="{{ $performance->id }}" multiple>
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