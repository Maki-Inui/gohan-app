@extends('layouts.app')
@section('title', 'edit-shop')
@section('content')
  <h3>お店情報を編集する</h3>  
    @if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
  <form action="{{ route('shops.update',$shop->id)}}" method="POST">
  @csrf
  @method('PUT')
    <div class="form-group">
        <label>お店の名前</label>
        <input type="text" name="name" value="{{ $shop->name }}">
    </div>
    <div class="form-group">
        <label>説明文</label>
        <textarea name="description">{{ $shop->description }}</textarea>
    </div>
    <input type="submit" value="更新する">
    <p><a href="{{ route('shops.index') }}">お店一覧画面へ戻る</a></p>
  </form>
@endsection