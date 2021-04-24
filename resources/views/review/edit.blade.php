@extends('layouts.app')
@section('title', 'edit-review')
@section('content')
  <h3>レビューを編集する</h3>  
    @include('layouts.error_message')
  <form action="{{ route('shops.review.update',['review'=>$review->id, 
  'shop'=>$review->shop_id])}}" method="POST">
  @csrf
  @method('PUT')
    <div class="form-group">
        <label>タイトル</label>
        <input type="text" name="title" value="{{ $review->title }}">
    </div>
    <div class="form-group">
        <label>レビュー</label>
        <textarea name="comment">{{ $review->comment }}</textarea>
    </div>
    <div class="form-group">
      <p>おすすめ度<p>
      <label><input type="radio" value="1" name="recommend_score" @if ($review->recommend_score == 1) checked @endif>1</label>
      <label><input type="radio" value="2" name="recommend_score" @if ($review->recommend_score == 2) checked @endif>2</label>
      <label><input type="radio" value="3" name="recommend_score" @if ($review->recommend_score == 3) checked @endif>3</label>
      <label><input type="radio" value="4" name="recommend_score" @if ($review->recommend_score == 4) checked @endif>4</label>
      <label><input type="radio" value="5" name="recommend_score" @if ($review->recommend_score == 5) checked @endif>5</label>
    </div> 
    <div class="form-group">
      <p>料理の満足度<p>
      <label><input type="radio" value="1" name="food_score" @if ($review->food_score == 1) checked @endif>1</label>
      <label><input type="radio" value="2" name="food_score" @if ($review->food_score == 2) checked @endif>2</label>
      <label><input type="radio" value="3" name="food_score" @if ($review->food_score == 3) checked @endif>3</label>
      <label><input type="radio" value="4" name="food_score" @if ($review->food_score == 4) checked @endif>4</label>
      <label><input type="radio" value="5" name="food_score" @if ($review->food_score == 5) checked @endif>5</label>
    </div> 
    <input type="submit" value="更新する">
  </form>
  <a href="{{ route('shops.show', ['shop'=>$review->shop_id]) }}">お店の詳細画面に戻る</a>
@endsection