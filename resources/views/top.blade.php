@extends('layouts.app')
@section('title', 'top-page')
@section('content')
<main class="pb-40 pt-0 bg-white">
  <div class="top-wrapper bg-cover bg-center ... pt-64 pb-64" style="background-image: url(image/hamburger.jpg)">
    <div class="container mx-auto">
      <ul class="text-lg text-white leading-normal ml-40">
        @if ($message = Session::get('failure'))
            <p style="color: red;">{{ $message }}</p>
        @endif
        @auth
          <li><buttun class="main-button"><a href="{{ route('mypage.show', ['mypage' => Auth::id() ]) }}">マイページ</a></button><li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <li><buttun class="main-button mt-4"><a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('ログアウト') }}
            </a></button><li>
          </form>
        @else
          <li><buttun class="main-button"><a href="{{ route('login') }}">ログイン</a></li>
          @if (Route::has('register'))
            <li><buttun class="main-button mt-4"><a href="{{ route('register') }}">ユーザー登録</a></li>
          @endif
        @endif
      </ul>
    </div>
  </div>
  <ul class="mt-24 w-9/12 mx-auto text-gray-500">
    <p class="text-center text-xl">このアプリの特徴</p>
    <li class="mt-24 flex justify-center">
      <div class="point w-4/12 mx-2"><img src="image/women3.jpg" alt=""></div>
      <div class="feature">
        <p class="text-xl"><span class="font-bold text-yellow-500">女性一人でも</span>気軽に</p>
        <p class="text-xl pt-1">入店できるお店を集めました</p>
      </div>
    </li>
    <li class="mt-24 flex justify-center">
      <div class="feature">
        <p class="text-xl">ラーメン、お寿司、焼き鳥、カレーなど</p>
        <p class="text-xl pt-1"><span class="font-bold text-yellow-500">様々なジャンル</span>のお店を紹介しています</p>
      </div>
      <div class="point w-4/12 mx-2"><img src="image/yummy.png" alt=""></div>
    </li>
    <li class="mt-24 flex justify-center">
      <div class="point w-4/12 mx-2"><img src="image/map.jpg" alt=""></div>
      <div class="feature">
        <p class="text-xl"><span class="font-bold text-yellow-500">エリア検索</span>でオフィスや自宅付近にある</p>
        <p class="text-xl pt-1">お店をチェックできます</p>
      </div>
    </li>
  </ul>
</main>
@endsection


