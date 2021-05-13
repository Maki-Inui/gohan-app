@extends('layouts.app')

@section('title', 'shop-page')
@section('content')
<main>
    <section style="text-align: center;">
        @if (Auth::check())
            @if(empty($visit))
            <form action="{{ route('shops.visit.store', ['shop' => $shop]) }}" method="POST">
            @csrf
                <input type="submit" value="行ったお店に登録する">
            </form>
            @else
            <p style='color: pink;'>行ったお店</p>
            <form action="{{ route('shops.visit.destroy', ['shop' => $shop, 'visit' => $visit]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="来店済みを解除">
            </form>
            @endif
            @if(empty($like))
            <form action="{{ route('shops.like.store', ['shop' => $shop]) }}" method="POST">
            @csrf
                <input type="submit" value="気になるお店に登録する">
            </form>
            @else
            <p style='color: orange;'>気になるお店</p>
            <form action="{{ route('shops.like.destroy', ['shop' => $shop, 'like' => $like]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="気になるお店を解除">
            </form>
            @endif
        @endif

        @if ($message = Session::get('success'))
            <p style="color: red;">{{ $message }}</p>
        @endif
        <p><a href="{{ route('shops.index') }}">お店一覧画面へ</a></p>
        <dl>
            <div class="shop_name">
                <h2>{{ $shop->name }}</h2>
            </div>
            <div class="description">
                <dt>
                    <h3>お店情報</h3>
                </dt>
                <dd>{{ $shop->description }}</dd>
            </div>
            <div class="recomend_score">
                <dt>
                    <h3>おすすめ度</h3>
                </dt>
                <dd>星{{ $shop->recommend_score }}個</dd>
            </div>
            <div class="food_score">
                <dt>
                    <h3>料理の満足度</h3>
                </dt>
                <dd>星{{ $shop->food_score }}個</dd>
            </div>
        </dl>
        <p><a href="{{ route('shops.review.create', ['shop' => $shop] ) }}" >レビューを投稿する</a></p>
    </section>
    <section style="text-align: center;">
    @if($reviews->isEmpty())
      <p>レビューがまだありません！</p>
      @else
          @foreach($reviews as $review)
            <div class="review" style="background-color: pink;">
                <h2>レビュータイトル：<a href ="{{ route('shops.review.show', ['shop' => $shop, 'review' => $review->id]) }}">{{ $review->title }}</a></h2>
                @if (Auth::check())
                    @if($review->nices()->where('user_id', $user_id)->exists())
                        @foreach($review->nices as $nice)
                        <form action="{{ route('shops.review.nice.destroy', ['shop' => $shop, 'review' => $review, 'nice' => $nice->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="いいねを解除">
                        </form>
                        @endforeach
                    @else
                    <form action="{{ route('shops.review.nice.store', ['shop' => $shop, 'review' => $review->id]) }}" method="POST">
                    @csrf
                        <input type="submit" value="いいねを押す">
                    </form>
                    @endif
                @endif
                <dl>
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
                <div class="edit">
                    <a href="{{ route('shops.review.edit', ['shop' => $shop, 'review' => $review]) }}">編集する</a>
                </div>
                <form action="{{ route('shops.review.destroy', ['shop' => $shop, 'review' => $review]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除する">
                </form>
            </div>
        @endforeach
    @endif
    </section>
</main>
@endsection