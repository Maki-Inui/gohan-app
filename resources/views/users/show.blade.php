@extends('layouts.app')

@section('title', 'user_description')
@section('content')
<main>
  <p>{{$user->name}}さん</p>
  @if (Auth::check())
    @if(Auth::id() !== $user->id)
      @if(empty($following))
      <form action="{{ route('users.follow.store', $user->id) }}" method="POST">
      @csrf
        <input type="submit" value="フォロー">
      </form>
      @else
      <form action="{{ route('users.follow.destroy', ['user' => $user->id, 'follow' => $following->id]) }}" method="POST">
      @csrf
      @method('DELETE')
        <input type="submit" value="フォロー解除">
      </form>
      @endif
    @endif
    @if($followed)
    <p style="color:pink;">{{ $user->name }}さんにフォローされています</p>
    @endif
  @endif
  @if($user->area_id == 0)
  <p>エリア登録なし</p>
  @else
  <p>よく行くエリア：{{ $user->area->area_name }}</p>
  @endif
  @if($user->profile !== null)
  <p>{{ $user->profile }}</p>
  @endif
  <a href="{{ url()->previous() }}">前のページに戻る</a>
</main>
@endsection