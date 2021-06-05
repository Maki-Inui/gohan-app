@extends('layouts.app')
@section('title', 'top-page')
@section('content')
<main class="pb-40 pt-0">
  <div class="top-wrapper bg-cover bg-center ... pt-64 pb-64" style="background-image: url(image/hamburger.jpg)">
    <div class="container mx-auto">
      <ul class="text-lg text-gray-600 leading-normal ml-40">
        @if ($message = Session::get('failure'))
            <p style="color: red;">{{ $message }}</p>
        @endif
        @auth
          <li><a href="{{ route('mypage.show', ['mypage' => Auth::id() ]) }}">マイページ</a></li>
          <li><form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-jet-responsive-nav-link>
          </form></li>
        @else
          <li><a href="{{ route('login') }}">ログイン</a></li>
          @if (Route::has('register'))
            <li><a href="{{ route('register') }}">ユーザー登録</a></li>
          @endif
        @endif
      </ul>
    </div>
  </div>
  <div class="message-wrapper text-center">
    <ul class="mt-16">このアプリの特徴</ul>
    <li class="mt-6">女性一人でも気軽に入店できるお店を集めました</li>
    <li>ラーメン、お寿司、焼き鳥、カレーなどジャンルは様々</li>
    <li>エリア検索でオフィスや自宅付近のお店をチェックできます</li>
  </div>
</main>
@endsection


