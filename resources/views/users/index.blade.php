@extends('layouts.app')

@section('title', 'user_list')
@section('content')
<main>
  @if ($message = Session::get('failure'))
  <p style="color: red;">{{ $message }}</p>
  @endif
  <p>登録ユーザー一覧</p>
    @foreach($all_users as $user)
      <ul class="article">
        <li><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></li>
      </ul>
    @endforeach
</main>
@endsection