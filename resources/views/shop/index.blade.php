@extends('layouts.app')

@section('title', 'shop-page')
@section('content')
<main>
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
            <div class="article" style="background-color: gray;">
                <h3>{{$shop->id}}:{{$shop->name}}</h3>
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
</main>
@endsection