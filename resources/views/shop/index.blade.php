@extends('layouts.app')

@section('title', 'shop-page')
@section('content')
<main class="bg-gray-100 pb-40">
    @if ($message = Session::get('failure'))
      <p style="color: red;">{{ $message }}</p>
    @endif
    @can('isAdmin')
    <p><a href="{{ route('shops.create') }}" class="btn btn-primary">新規のお店を登録する</a></p>
    @endcan
    <section style="text-align: center;">
      @if ($message = Session::get('success'))
            <p style="color: red;">{{ $message }}</p>
      @endif

      @if($shops->isEmpty())
      <p>登録がありません</p>  
      @else
          @foreach($shops as $shop)
            <div class="article bg-white w-2/5 mx-auto p-6 shadow">
                <h3 class="text-3xl">{{$shop->id}}:<a href="{{ route('shops.show', $shop->id) }}">{{$shop->name}}</a></h3>
                <div class="shop_area">
                    <p>{{ $shop->area->area_name }}</p>
                </div>
                <ul>
                  <li>おすすめ度→星{{ $shop->recommend_score }}個</li>
                  <li>料理の満足度→星{{ $shop->food_score }}個</li>
                </ul>
                @can('isAdmin')
                <a href="{{ route('shops.edit', $shop->id) }}">編集する</a>
                <form action="{{ route('shops.destroy', $shop->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除する">
                </form>
                @endcan
            </div>
          @endforeach
      @endif
    </section>
    <a href="{{ url('/') }}">トップページに戻る</a>
</main>
@endsection