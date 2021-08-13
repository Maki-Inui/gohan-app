@extends('layouts.app')
@section('title', 'manpukuアプリ -フォロワーリスト-')
@section('content')
<main>
  <h3 class="text-center">{{ Auth::user()->name }}さんをフォロー中のユーザー</h3>
  <div class="">
    @if($followers->isEmpty())
    <p class="article w-4/5 lg:w-2/5 rounded-lg">フォローしているユーザーはいません</p>
    @else
      @foreach($followers as $follower)
      <ul class="article w-4/5 lg:w-2/5">
        <li><a href="{{  route('users.show', $follower->user_id ) }}">{{ Auth::user()->followed($follower->user_id)->name }}</a></li>
        <li>よく行くエリア：{{ Auth::user()->followed($follower->user_id)->area_name }}</li>
      </ul>
      @endforeach
    @endif
  </div>
  <p class="mt-6 text-gray-400 text-center"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">mypageへ戻る</a></p>
</main>
@endsection