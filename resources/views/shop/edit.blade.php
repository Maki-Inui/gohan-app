@extends('layouts.app')
@section('title', 'edit-shop')
@section('content')
<main>
  <div class="wrapper w-2/5 mx-auto p-6">
    <h3>お店情報を編集する</h3>  
      @include('layouts.error_message')
    <form action="{{ route('shops.update', $shop->id) }}" method="POST">
    @csrf
    @method('PUT')
      <div class="form-group">
          <label>お店の名前</label><br>
          <input type="text" name="name" value="{{ $shop->name }}">
      </div>
      <div class="form-group">
          <label>説明文</label><br>
          <textarea name="description">{{ $shop->description }}</textarea>
      </div>
      <button class="mt-6 py-2 px-6 rounded bg-red-300 hover:bg-yellow-300 text-gray-800" type="submit">更新する</button>
      <p class="mt-6"><a href="{{ route('shops.index') }}">お店一覧画面へ戻る</a></p>
    </form>
  </div>
</main>
@endsection