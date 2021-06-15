@extends('layouts.app')
@section('title', 'shop-page')
@section('content')
<main>
  @if ($message = Session::get('failure'))
  <p style="color: red;">{{ $message }}</p>
  @endif
  <p class="mb-6 text-center">お店の一覧ページです</p>
  @can('isAdmin')
  <p class="text-indigo-600 text-center"><a href="{{ route('shops.create') }}" class="btn btn-primary">新規のお店を登録する(管理者メニュー)<i class="fas fa-desktop"></i></a></p>
  @endcan
  <section style="text-align: center;">
    @if ($message = Session::get('success'))
    <p style="color: red;">{{ $message }}</p>
    @endif

    @if($shops->isEmpty())
    <p>登録がありません</p>
    @else
    @foreach($shops as $shop)
    <div class="article bg-white w-4/5 lg:w-2/5 mt-10 mx-auto p-10 shadow">
      <a href="{{ route('shops.show', $shop->id) }}">
        <h3 class="text-3xl pb-1 font-bold text-indigo-600">{{$shop->id}}:{{$shop->name}}</h3>
        <div class="flex justify-center">
          <div class="shop_area">
            <p>{{ $shop->area->area_name }}/</p>
          </div>
          <div class="shop_category">
            <p>{{ $shop->category->category_name }}</p>
          </div>        
        </div>
        <ul class="py-6">
          <li>おすすめ度→★ｘ{{ $shop->recommend_score }}個</li>
          <li>料理の満足度→★ｘ{{ $shop->food_score }}個</li>
        </ul>
        @if( $shop->image )
        <div class="mx-auto my-0 w-10/12"><img class="mx-auto" src="{{ asset( 'image/' . $shop->image ) }}" alt="画像"></div>
        @else
        <div class="mx-auto my-0 w-10/12"><img class="mx-auto" src="{{ url( 'https://placehold.jp/320x240.png?text=No Image' ) }}" alt="画像"></div>
        @endif
        @can('isAdmin')
        <a href="{{ route('shops.edit', $shop->id) }}">編集する<i class="fas fa-pencil-alt"></i></a>
        <form action="{{ route('shops.destroy', $shop->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="icon-button" type="submit">削除する<i class="fas fa-trash-alt"></i></button>
        </form>
        @endcan
      </a>
    </div>
    @endforeach
    @endif
  </section>
  <div class="mt-10 text-center text-gray-400"><a href="{{ url('/') }}">トップページに戻る</a></div>
</main>
@endsection