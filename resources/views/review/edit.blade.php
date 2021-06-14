@extends('layouts.app')
@section('title', 'edit-review')
@section('content')
<main>
  <div class="wrapper w-4/5 lg:w-2/5">
    <h3>レビューを編集できます</h3>
    @include('layouts.error_message')
    <form action="{{ route('shops.review.update', ['review' => $review->id, 'shop' => $review->shop_id])}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label>タイトル</label><br>
        <input class="title" type="text" name="title" value="{{ $review->title }}">
      </div>
      <div class="form-group">
        <label>レビュー</label><br>
        <textarea class="w-5/6" name="comment">{{ $review->comment }}</textarea>
      </div>
      <div class="form-group">
        <p>おすすめ度</p>
        <label><input type="radio" value="1" name="recommend_score" @if ($review->recommend_score == 1) checked @endif>1</label>
        <label><input type="radio" value="2" name="recommend_score" @if ($review->recommend_score == 2) checked @endif>2</label>
        <label><input type="radio" value="3" name="recommend_score" @if ($review->recommend_score == 3) checked @endif>3</label>
        <label><input type="radio" value="4" name="recommend_score" @if ($review->recommend_score == 4) checked @endif>4</label>
        <label><input type="radio" value="5" name="recommend_score" @if ($review->recommend_score == 5) checked @endif>5</label>
      </div>
      <div class="form-group">
        <p>料理の満足度
        <p>
          <label><input type="radio" value="1" name="food_score" @if ($review->food_score == 1) checked @endif>1</label>
          <label><input type="radio" value="2" name="food_score" @if ($review->food_score == 2) checked @endif>2</label>
          <label><input type="radio" value="3" name="food_score" @if ($review->food_score == 3) checked @endif>3</label>
          <label><input type="radio" value="4" name="food_score" @if ($review->food_score == 4) checked @endif>4</label>
          <label><input type="radio" value="5" name="food_score" @if ($review->food_score == 5) checked @endif>5</label>
      </div>
      <div class="form-group">
        <input type="file" name="image">
      </div>
      <button type="submit" class="mt-6 p-2 rounded bg-red-300 hover:bg-yellow-300 text-gray-800">更新する</button>
    </form>
    <div class="mt-6">
      <a href="{{ route('shops.show', ['shop' => $review->shop_id]) }}">お店の詳細画面に戻る</a>
    </div>
  </div>
</main>
@endsection