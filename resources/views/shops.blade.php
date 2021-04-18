@extends('layouts.app')

@section('title', 'shop-page')
@section('content')
<main>
    <section style="text-align: center;">
        @if ($message = Session::get('success'))
            <p style="color: red;">{{ $message }}</p>
        @endif
        <p><a href="{{ route('shops.index') }}">お店一覧画面へ</a></p>
        <h2>{{ $shop->name }}</h2>

        <div class="description">
            <h3>お店情報</h3>
            {{ $shop->description }}
        </div>

        <div class="recomend_score">
            <h3>おすすめ度</h3>
            <p>星{{ $shop->recommend_score }}個</p>
        </div>

        <div class="food_score">
            <h3>料理の満足度</h3>
            <p>星{{ $shop->food_score }}個</p>
        </div>
        <p><a href="{{ route('review.create') }}" >レビューを投稿する</a></p>

    </section>
      
</main>
@endsection