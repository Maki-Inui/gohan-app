@extends('layouts.app')

@section('title', 'top-page')

@include('layouts.header')

@auth
  <a href="{{ url('/') }}">mypage</a>
@else
  <a href="{{ route('login') }}">Login</a>
  @if (Route::has('register'))
      <a href="{{ route('register') }}">Register</a>
  @endif
@endif

<main>
</main>

<footer>
</footer>
