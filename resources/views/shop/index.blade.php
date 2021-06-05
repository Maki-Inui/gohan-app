@extends('layouts.app')

@section('title', 'shop-page')
@section('content')
<main>
    @if ($message = Session::get('failure'))
      <p style="color: red;">{{ $message }}</p>
    @endif
    @can('isAdmin')
    <p class="mb-6 text-center">お店の一覧ページです<span class="ml-8 text-indigo-600"><a href="{{ route('shops.create') }}" class="btn btn-primary">新規のお店を登録する(管理者メニュー)</a></span></p>
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
                <h3 class="text-3xl font-bold">{{$shop->id}}:<a href="{{ route('shops.show', $shop->id) }}">{{$shop->name}}</a></h3>
                <div class="shop_area">
                    <p>{{ $shop->area->area_name }}</p>
                </div>
                <ul class="py-6">
                  <li>おすすめ度→★ｘ{{ $shop->recommend_score }}個</li>
                  <li>料理の満足度→★ｘ{{ $shop->food_score }}個</li>
                </ul>
                @can('isAdmin')
                <a href="{{ route('shops.edit', $shop->id) }}">編集する<i class="fas fa-pencil-alt"></i></a>
                <form action="{{ route('shops.destroy', $shop->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="icon-button" type="submit">削除する<i class="fas fa-trash-alt"></i></button>
                </form>
                @endcan
            </div>
          @endforeach
      @endif
    </section>
    <div class="mt-8 text-center text-gray-400"><a href="{{ url('/') }}">トップページに戻る</a></div>
</main>
@endsection