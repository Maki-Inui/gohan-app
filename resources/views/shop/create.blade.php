@extends('layouts.app')
@section('title', 'create-shop')
@section('content')
<main>
  <div class="wrapper w-2/5 mx-auto p-6">
    <h3>新規のお店を登録する</h3>
    @include('layouts.error_message')
    <form method="post" action="{{ route('shops.store') }}">
    @csrf
      <div class="form-group">
        <label for="shopName">お店の名前</label><br>
        <input type="text" name="name">
      </div>
      <div class="form-group">
        <label for="shopArea">エリア</label><br>
        <select name="area_id">
          @foreach ($areas as $value)
            <option value="{{ $value->id }}">{{ $value->area_name }}</option>
          @endforeach
          </select>
      </div>
      <div class="form-group">
        <label for="descInput">説明文</label><br>
        <textarea name="description"></textarea>
      </div>
      <button class="mt-6 py-2 px-6 rounded bg-red-300 hover:bg-yellow-300 text-gray-800" type="submit">新規追加</button>
    </form>
  </div>
  <div class="mt-8 text-center text-gray-400">
      <a class="p-4" href="{{ route('shops.index') }}">お店一覧ページへ戻る</a>
  </div>
</main>
@endsection