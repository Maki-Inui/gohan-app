@extends('layouts.app')
@section('title', 'your-visits')
@section('content')
<main>
  <h3>{{ Auth::user()->name }}さんの行ったお店一覧</h3>
  @if($visits->isEmpty())
    <p>行ったお店はありません</p>
  @else
    @foreach($visits as $visit)
    <ul class="article">
      <li><a href="{{  route('shops.show', $visit->shop_id) }}">{{ $visit->shop->name }}</a></li>
    </ul>
    @endforeach
  @endif
    <a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">mypageへ戻る</a>
</main>
@endsection
