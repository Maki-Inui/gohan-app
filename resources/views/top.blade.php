@extends('layouts.app')

@section('title', 'top-page')

@section('nav')

  @auth
    <a href="{{ url('/') }}">mypage</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <x-jet-responsive-nav-link href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      this.closest('form').submit();">
          {{ __('Log Out') }}
      </x-jet-responsive-nav-link>
    </form>
  @else
    <a href="{{ route('login') }}">Login</a>
    @if (Route::has('register'))
        <a href="{{ route('register') }}">Register</a>
    @endif
  @endif

@endsection

<main>
</main>


