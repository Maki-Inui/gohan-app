@extends('layouts.app')
@section('title', 'your-visits')
@section('content')
<main>
  <h3>{{ $user->name }}さんの行ったお店一覧</h3>
  @if(empty($visits))
      <p>行ったお店はありません</p>
    @else
      @foreach($visits as $visit)
      <ul class="article">
        <li><a href="{{  route('shops.show', $visit->shop_id) }}">{{ $visit->shop->name }}</a></li>
      </ul>
      @endforeach
  @endif
    <a href="{{ route('mypage.show', ['mypage' => $user]) }}">mypageへ戻る</a>
</main>
@endsection
