@extends('layouts.app')

@section('title', 'review')
@section('content')
<main>
  <h2>レビュー</h2>
  <dl>
    <div class="description">
      <dt>
          <h3>タイトル</h3>
      </dt>
      <dd>{{ $review->title }}</dd>
    </div>
    <div class="description">
      <dt>
          <h3>投稿者</h3>
      </dt>
    <dd><a href="{{ route('users.show', ['user' => $review->user_id]) }}">{{ $review->user->name }}</a></dd>
    <div class="description">
      <dt>
          <h3>コメント</h3>
      </dt>
      <dd>{{ $review->comment }}</dd>
    </div>
    <div class="recomend_score">
        <dt>
            <h3>おすすめ度</h3>
        </dt>
        <dd>星{{ $review->recommend_score }}個</dd>
    </div>
    <div class="food_score">
        <dt>
            <h3>料理の満足度</h3>
        </dt>
        <dd>星{{ $review->food_score }}個</dd>
      </div>
  </dl>
  <a href="{{ route('shops.show', ['shop' => $review->shop_id]) }}">お店のレビュー一覧に戻る</a>
</main>
@endsection