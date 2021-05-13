@extends('layouts.app')

@section('title', 'user_list')
@section('content')
<main>
  <p>登録ユーザー一覧</p>
    @foreach($all_users as $user)
      <ul class="article">
        <li><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></li>
      </ul>
    @endforeach
</main>
@endsection