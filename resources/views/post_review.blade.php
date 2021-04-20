@extends('layouts.app')

@section('title', 'post-review')
@section('content')
<h3>レビュー投稿画面</h3>
    <form action="{{ route('shops.review.store','$id')}}" method="POST">
        @csrf
        <input name="shop_id" type="hidden" value="{{ $shop }}">
        <div class="form-group">
            <label>投稿タイトル</label>
            <input type="text" name="title">
        </div>
        <div class="form-group">
            <label>レビュー</label>
            <textarea name="comment"></textarea>
        </div>
        <input type="submit" value="登録">
    </form>
    <p><a href="{{ route('shops.show',['shop'=>$shop])}}">お店情報へ戻る</a></p>
@endsection