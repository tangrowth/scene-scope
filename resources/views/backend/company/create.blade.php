@extends('layouts.header')
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('main')
<div>
  <h1>劇団の追加</h1>
  <form action="{{ route('company.create') }}" method="POST">
    @csrf
    <table>
      <tr>
        <td>劇団名</td>
        <td><input type="text" name="name"></td>
      </tr>
      <tr>
        <td>管理ユーザー</td>
        <td><select name="user_id">
          @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select></td>
      </tr>
    </table>
    <button>作成</button>
  </form>
</div>
@endsection