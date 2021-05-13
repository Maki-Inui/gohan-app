@extends('layouts.app')
@section('title', 'top-page')
@section('nav')
<ul>
  @auth
    <li><a href="{{ route('mypage.show', ['mypage' => $user]) }}">mypage</a></li>
    <li><form method="POST" action="{{ route('logout') }}">
      @csrf
      <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
          {{ __('Log Out') }}
      </x-jet-responsive-nav-link>
    </form></li>
  @else
    <li><a href="{{ route('login') }}">Login</a></li>
    @if (Route::has('register'))
      <li><a href="{{ route('register') }}">Register</a></li>
    @endif
  @endif
  <li><a href="{{ route('shops.index') }}">お店一覧はこちら</a></li>
</ul>
@endsection
@section('content')
<main>
</main>
@endsection


