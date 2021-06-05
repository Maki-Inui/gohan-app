@extends('layouts.app')
@section('title', 'your-visits')
@section('content')
<main>
  <h3 class="text-center">{{ Auth::user()->name }}さんの行ったお店一覧</h3>
  <div class="article bg-white w-2/5 mx-auto mt-6 p-6 shadow">
  @if($visits->isEmpty())
    <p>行ったお店はありません</p>
  @else
    @foreach($visits as $visit)
    <ul class="article">
      <li><a href="{{  route('shops.show', $visit->shop_id) }}">{{ $visit->shop->name }}</a></li>
      <li>{{ $visit->shop->area->area_name }}</li>
    </ul>
    @endforeach
  @endif
  </div>
  <p class="mt-6 text-gray-400 text-center"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">mypageへ戻る</a></p>
</main>
@endsection
