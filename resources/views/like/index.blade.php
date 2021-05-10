@extends('layouts.app')
@section('title', 'your-likes')
@section('content')
<h3>{{ $user->name }}さんの気になるお店一覧</h3>
@if($likes->isEmpty())
    <p>お気に入りのお店はありません</p>
@else
    @foreach($likes as $like)
    <div class="article">
    <li><a href="{{  route('shops.show',$like->shop_id) }}">{{ $like->shop->name }}</a></li>
    </div>
    @endforeach
@endif
  <a href="{{ route('mypage.show',['mypage'=>$user])}}">mypageへ戻る</a>
@endsection
