@extends('layouts.app')

@section('title', 'shop-page')
@section('content')
<main>
    <section style="text-align: center;">


      @if($shop_list->isEmpty())
        
      @else
          @foreach($shop_list as $shop)
              <div class="article" style="background-color: gray;">
                  <p>{{$shop->id}}{{$shop->name}}</p>
                  <p>おすすめ度→星{{ $shop->recommend_score }}個</p>
                  <p>料理の満足度→星{{ $shop->food_score }}個</p>
              </div>
          @endforeach
      @endif

    </section>
      
</main>
@endsection