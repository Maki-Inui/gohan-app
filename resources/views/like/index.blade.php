@extends('layouts.app')
@section('title', 'your-likes')
@section('content')
<main>
  <h3>{{ $user->name }}さんの気になるお店一覧</h3>
  @if($likes->isEmpty())
      <p>お気に入りのお店はありません</p>
  @else
      @foreach($likes as $like)
      <ul class="article">
        <li><a href="{{  route('shops.show', $like->shop_id) }}">{{ $like->shop->name }}</a></li>
      </ul>
      @endforeach
  @endif
    <a href="{{ route('mypage.show', ['mypage' => $user]) }}">mypageへ戻る</a>
</main>
@endsection
