@extends('layouts.app')

@section('title', 'user_description')
@section('content')
<main>
  <p>{{$user->name}}さん</p>
  @if (Auth::check())
    @if($login_user->id !== $user->id)
      @if($follow === null)
      <form action="{{ route('users.follow.store', $user->id) }}" method="POST">
      @csrf
      <input type="submit" value="フォロー">
      </form>
      @else
      <form action="{{ route('users.follow.destroy', ['user' =>$user->id,'follow'=>$follow->id,]) }}" method="POST">
      @csrf
      @method('DELETE')
      <input type="submit" value="フォロー解除">
      @endif
    @endif
    @if($login_user->followUsers()->where('user_id',$user->id)->first())
    <p style="color:pink;">{{$user->name}}さんにフォローされています</p>
    @endif
  @endif
  @if($user->area_id !== 0)
  <p>よく行くエリア：{{$user->area->area_name}}</p>
  @else
  <p>エリア登録なし</p>
  @endif
  @if($user->profile !== null)
  <p>{{$user->profile}}</p>
  @else
  @endif
</main>
@endsection