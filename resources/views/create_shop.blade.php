@extends('layouts.app')
@section('title', 'create-shop')
@section('content')
  <h3>新規のお店を登録する</h3>
  @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
  <form method="post" action="{{ route('shops.store')}}">
  @csrf
    <div class="form-group">
      <label for="shopName">お店の名前</label>
      <input type="text" name="name">
    </div>
    <div class="form-group">
    <label for="descInput">説明文</label>
    <textarea name="description"></textarea>
    </div>
    <button type="submit">新規追加</button>
  </form>
@endsection