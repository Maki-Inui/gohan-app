@extends('layouts.app')
@section('title', 'your-shop_history')
@section('content')
<main>
  <h3>{{ $user->name }}さんのお店の閲覧履歴</h3>
  @if($histories->isEmpty())
    <p>履歴はありません</p> 
  @else
    @foreach($histories as $history)
    <ul class="article">
      <li><a href="{{  route('shops.show', ['shop' => $history->shop_id]) }}">{{ $history->shop->name }}</a>：{{ $history->shop->description }}</li>
    </ul>
    @endforeach
  @endif
    <a href="{{ route('mypage.show', ['mypage' => $user]) }}">mypageへ戻る</a>
</main>
@endsection