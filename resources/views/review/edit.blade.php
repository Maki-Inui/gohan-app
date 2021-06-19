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
        <p>料理の満足度</p>
        <label><input type="radio" value="1" name="food_score" @if ($review->food_score == 1) checked @endif>1</label>
        <label><input type="radio" value="2" name="food_score" @if ($review->food_score == 2) checked @endif>2</label>
        <label><input type="radio" value="3" name="food_score" @if ($review->food_score == 3) checked @endif>3</label>
        <label><input type="radio" value="4" name="food_score" @if ($review->food_score == 4) checked @endif>4</label>
        <label><input type="radio" value="5" name="food_score" @if ($review->food_score == 5) checked @endif>5</label>
      </div>
      <button type="submit" class="mt-6 p-2 rounded bg-red-300 hover:bg-yellow-300 text-gray-800">更新する</button>
    </form>
    <p class="mt-10">画像の追加と削除ができます<br>※最大４つまで</p>
    @if($review->photos)
    <div class="flex flex-wrap justify-start mt-4 text-sm">
      <div class="review-photo-display w-5/12 lg:w-3/12">
        <div class="mx-auto my-0">
          <img class="mx-auto w-11/12 py-1" src="{{ asset( 'image/review/' . $review->main_photo()->path ) }}" alt="画像">
        </div>
        <p class="text-center">画像１</p>
        <div class="button-photo-delete">
          <form action="{{ route('review.photo.destroy', ['review' => $review, 'photo' => $review->main_photo()->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="icon-button" type="submit" value="削除する">削除<i class="fas fa-trash-alt"></i></button>
          </form>
        </div>
      </div>
      @endif
      @if($review->second_photo())
      <div class="review-photo-display w-5/12 lg:w-3/12">
        <div class="mx-auto my-0">
          <img class="mx-auto w-11/12 py-1" src="{{ asset( 'image/review/' . $review->second_photo()->path ) }}" alt="画像">
        </div>
        <p class="text-center">画像２</p>
        <div class="button-photo-delete">
          <form action="{{ route('review.photo.destroy', ['review' => $review, 'photo' => $review->second_photo()->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="icon-button" type="submit" value="削除する">削除<i class="fas fa-trash-alt"></i></button>
          </form>
        </div>
      </div>
      @endif
      @if($review->third_photo())
      <div class="review-photo-display w-5/12 lg:w-3/12 mt-4 lg:mt-0">
        <div class="mx-auto my-0">
          <img class="mx-auto w-11/12 py-1" src="{{ asset( 'image/review/' . $review->third_photo()->path ) }}" alt="画像">
        </div>
        <p class="text-center">画像３</p>
        <div class="button-photo-delete">
          <form action="{{ route('review.photo.destroy', ['review' => $review, 'photo' => $review->third_photo()->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="icon-button" type="submit" value="削除する">削除<i class="fas fa-trash-alt"></i></button>
          </form>
        </div>
      </div>
      @endif
      @if($review->fourth_photo())
      <div class="review-photo-display w-5/12 lg:w-3/12 mt-4 lx:mt-0">
        <div class="mx-auto my-0">
          <img class="mx-auto w-11/12 py-1" src="{{ asset( 'image/review/' . $review->fourth_photo()->path ) }}" alt="画像">
        </div>
        <p class="text-center">画像４</p>
        <div class="button-photo-delete">
          <form action="{{ route('review.photo.destroy', ['review' => $review, 'photo' => $review->fourth_photo()->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="icon-button" type="submit" value="削除する">削除<i class="fas fa-trash-alt"></i></button>
          </form>
        </div>
      </div>
      @endif
    </div>
    @if($review->photos_count() == 0)
    <div class="lg:flex form-group">
        <form action="{{ route('review.photo.store', ['review' => $review]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="image" id="image2">
          <button class="button-photo-add" type="submit">画像を追加</button>
        </form>
    </div>
    @endif
    @if($review->photos_count() <= 1) 
    <div class="flex form-group">
      <form action="{{ route('review.photo.store', ['review' => $review]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" id="image2">
        <button class="button-photo-add" type="submit">画像を追加</button>
      </form>
    </div>
  @endif
  @if($review->photos_count() <= 2) 
  <div class="lg:flex form-group">
    <form action="{{ route('review.photo.store', ['review' => $review]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="image" id="image3">
      <button class="button-photo-add" type="submit">画像を追加</button>
    </form>
    </div>
    @endif
    @if($review->photos_count() <= 3) 
    <div class="lg:flex form-group">
      <form action="{{ route('review.photo.store', ['review' => $review]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" id="image3">
        <button class="button-photo-add" type="submit">画像を追加</button>
      </form>
      </div>
      @endif
      <div class="mt-10 text-gray-400">
        <a href="{{ route('shops.show', ['shop' => $review->shop_id]) }}">お店の詳細画面に戻る</a>
      </div>
      </div>
</main>
@endsection