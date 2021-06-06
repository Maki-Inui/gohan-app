@extends('layouts.app')
@section('title', 'your-likes')
@section('content')
<main>
  <h3 class="text-center">{{ Auth::user()->name }}さんの気になるお店一覧</h3>
  <div class="article bg-white w-2/5 mx-auto mt-6 p-6 shadow">
    @if($likes->isEmpty())
      <p>お気に入りのお店はありません</p>
    @else
      @foreach($likes as $like)
      <ul class="article">
        <li><a href="{{  route('shops.show', $like->shop_id) }}">{{ $like->shop->name }}</a></li>
        <li>{{ $like->shop->area->area_name }}</li>
      </ul>
      @endforeach
    @endif
  </div>
  <p class="mt-6 text-gray-400 text-center"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">mypageへ戻る</a></p>
</main>
@endsection
