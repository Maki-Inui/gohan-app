@extends('layouts.app')
@section('nav')
<a href="{{  route('mypage.visit.index',$user->id) }}">行ったお店リスト</a>
<a href="{{  route('mypage.like.index',$user->id) }}">気になるお店リスト</a>
<a href="{{  route('mypage.history.index',$user->id) }}">お店の閲覧履歴</a>
@endsection
@section('title', 'my-page')
@section('content')
<h3>こんにちは{{ $user->name }}さん</h3>

  @if($user->area_id == 0)

    <p>エリア未登録です <a href="{{  route('mypage.edit',$user->id) }}">登録はこちら</a></p>  
  @else
  <p>よく行くエリア：{{ $user->area->area_name }} <a href="{{  route('mypage.edit',$user->id) }}">エリアを変更する(プロフィール編集)</a></p>
  @endif
<a href="{{ url('/') }}">トップページに戻る</a>
@endsection

<main>
</main>