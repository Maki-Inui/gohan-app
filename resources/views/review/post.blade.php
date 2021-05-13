@extends('layouts.app')

@section('title', 'post-review')
@section('content')
<main>
    <h3>レビュー投稿画面</h3>
    @include('layouts.error_message')
    <form action="{{ route('shops.review.store', $shop) }}" method="POST">
        @csrf
        <input name="shop_id" type="hidden" value="{{ $shop }}">
        <div class="form-group">
            <p>おすすめ度<p>
            <input type="radio" name="recommend_score" value="1">
            <label for="1">1</label>
            <input type="radio" name="recommend_score" value="2">
            <label for="1">2</label>
            <input type="radio" name="recommend_score" value="3" checked>
            <label for="1">3</label>
            <input type="radio" name="recommend_score" value="4">
            <label for="1">4</label>
            <input type="radio" name="recommend_score" value="5">
            <label for="1">5</label>
        </div>
        <div class="form-group">
            <p>料理の満足度<p>
            <input type="radio" name="food_score" value="1">
            <label for="1">1</label>
            <input type="radio" name="food_score" value="2">
            <label for="1">2</label>
            <input type="radio" name="food_score" value="3" checked>
            <label for="1">3</label>
            <input type="radio" name="food_score" value="4">
            <label for="1">4</label>
            <input type="radio" name="food_score" value="5">
            <label for="1">5</label>
        </div>
        <div class="form-group">
            <label>投稿タイトル</label>
            <input type="text" name="title">
        </div>
        <div class="form-group">
            <label>レビュー</label>
            <textarea name="comment"></textarea>
        </div>
        <input type="submit" value="登録">
    </form>
    <p><a href="{{ route('shops.show', ['shop' => $shop])}}">お店情報へ戻る</a></p>
</main>
@endsection