@extends('layouts.app')
@section('title', 'my-page')
@section('content')
<main>
  <h3 class="text-center">マイページ</h3>
  <section class="article bg-white w-2/5 mx-auto mt-6 p-6 shadow rounded-lg">
    <h3>こんにちは{{ Auth::user()->name }}さん</h3>
    <ul class="mt-8">
      @if(Auth::user()->area_id == 0)
      <li>エリア未登録です <a href="{{  route('mypage.edit', Auth::id()) }}">登録はこちら</a></li>
      @else
      <li>よく行くエリア：{{ Auth::user()->area->area_name }} <a class="text-indigo-600" href="{{  route('mypage.edit', Auth::id()) }}">エリアを変更する(プロフィール編集)</a></li>
      @endif
      <li class="mt-2"><a href="{{  route('mypage.history.index', Auth::id()) }}">お店の閲覧履歴<i class="fas fa-user-plus"></i></a></li>
    </ul>
  </section>
  <p class="mt-6 text-gray-400 text-center"><a href="{{ url('/') }}">トップページに戻る</a></p>
</main>
@endsection
