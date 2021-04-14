@extends('layouts.app')

@section('title', 'shop-page')
@section('content')
<main>
    <section style="text-align: center;">
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

    </section>
      
</main>
@endsection