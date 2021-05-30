@extends('layouts.app')

@section('title', 'shop-page')
@section('content')
<main>
    <p class="text-center p-4">お店の詳細ページです</p>
    <section class="article bg-white w-2/5 mx-auto p-6 shadow">
        @if (Auth::check())
            @if($has_shop_visit)
            <p style='color: pink;'>行ったお店</p>
            <i class="far fa-heart"></i>
            <form action="{{ route('shops.visit.destroy', ['shop' => $shop, 'visit' => $has_shop_visit]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="来店済みを解除">
            </form>
            @else
            <form action="{{ route('shops.visit.store', ['shop' => $shop]) }}" method="POST">
                @csrf
                <input type="submit" value="行ったお店に登録する">
            </form>
            @endif
            @if($has_shop_like)
            <p style='color: orange;'>気になるお店</p>
            <form action="{{ route('shops.like.destroy', ['shop' => $shop, 'like' => $has_shop_like]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="気になるお店を解除">
            </form>
            @else
            <form action="{{ route('shops.like.store', ['shop' => $shop]) }}" method="POST">
                @csrf
                <input type="submit" value="気になるお店に登録する">
            </form>
            @endif
        @endif

        @if ($message = Session::get('success'))
            <p style="color: red;">{{ $message }}</p>
        @endif
        <div class="shop_name text-3xl">
            <h2>{{ $shop->name }}</h2>
        </div>
        <div class="shop_area">
            <p>{{ $shop->area->area_name }}</p>
        </div>
        <dl class="border-2 rounded border-yellow-300 border-opacity-75 ...">
            <div class="description">
                <dt>
                    <h3>お店情報</h3>
                </dt>
                <dd class="text-center">{{ $shop->description }}</dd>
            </div>
            <div class="recomend_score">
                <dt>
                    <h3>おすすめ度</h3>
                </dt>
                <dd class="text-center">星{{ $shop->recommend_score }}個</dd>
            </div>
            <div class="food_score">
                <dt>
                    <h3>料理の満足度</h3>
                </dt>
                <dd class="text-center">星{{ $shop->food_score }}個</dd>
            </div>
        </dl>
        @auth
        <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
            <a href="{{ route('shops.review.create', ['shop' => $shop] ) }}" >レビューを投稿する</a>
        </button>
        @endauth
    </section>
    <section style="text-align: center;">
    @if($reviews->isEmpty())
      <p>レビューがまだありません！</p>
      @else
          @foreach($reviews as $review)
            <div class="review" style="background-color: pink;">
                <h2>レビュータイトル：<a href ="{{ route('shops.review.show', ['shop' => $shop, 'review' => $review->id]) }}">{{ $review->title }}</a></h2>
                <p>投稿者<a href="{{ route('users.show', ['user' => $review->user_id]) }}">{{ $review->user->name }}</a>
                @if (Auth::check())
                        @if(Auth::user()->hasReviewNice($review->id))
                        @foreach($review->userNices as $nice)
                        <form action="{{ route('shops.review.nice.destroy', ['shop' => $shop, 'review' => $review, 'nice' => $nice->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="いいねを解除">
                        </form>
                        @endforeach
                    @else
                    <i class="fas fa-heart"></i>
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
                @auth
                    @if ($review->user_id == Auth::id()) 
                    <div class="edit">
                        <a href="{{ route('shops.review.edit', ['shop' => $shop, 'review' => $review]) }}">編集する</a>
                    </div>
                    <form action="{{ route('shops.review.destroy', ['shop' => $shop, 'review' => $review]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="削除する">
                    </form>
                    @endif
                @endauth
            </div>
        @endforeach
    @endif
    <a class="text-center p-4" href="{{ route('shops.index') }}">お店一覧ページへ</a>
    </section>
</main>
@endsection