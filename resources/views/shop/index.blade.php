@extends('layouts.app')

@section('title', 'shop-page')
@section('content')
<main>
    <p><a href="{{ route('shops.create') }}" class="btn btn-primary">新規のお店を登録する</a></p>
    <section style="text-align: center;">
      @if ($message = Session::get('success'))
            <p style="color: red;">{{ $message }}</p>
      @endif

      @if($shop_index->isEmpty())

      <p>登録がありません</p>
        
      @else
          @foreach($shop_index as $shop)
              <div class="article" style="background-color: gray;">
                  <p>{{$shop->id}}{{$shop->name}}</p>
                  <p>おすすめ度→星{{ $shop->recommend_score }}個</p>
                  <p>料理の満足度→星{{ $shop->food_score }}個</p>
                  <a href="{{ route('shops.edit',$shop->id)}}">編集する</a>
                  <form action="{{ route('shops.destroy', $shop->id)}}" method="POST">
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