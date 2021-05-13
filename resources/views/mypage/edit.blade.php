@extends('layouts.app')
@section('title', 'change_area-page')
@section('content')
<main>
  <form action="{{ route('mypage.update', $user->id) }}" method="POST">
  @csrf
    @method('PUT')
    @if($user->area_id == 0)
      <div class="form-group">
          <label>よく行くエリアの設定</label>
          <select name="area_id">
          @foreach ($areas as $value)
            <option value="{{ $value->id }}">{{ $value->area_name }}</option>
          @endforeach
          </select>
      </div>
      <div class="form-group">
          <label>プロフィールの登録</label><br>
          <textarea name="profile" placeholder="プロフィール文を入力してください"></textarea>
      </div>
      <input type="submit" value="登録する">
    @else
    <h3>{{ $user->name }}さんの設定エリア</h3>
    <p>現在のエリア：{{ $area->area_name }} </p>
    <p>↓</p>
      <div class="form-group">
          <label>変更後のエリア</label>
          <select name="area_id">
          @foreach ($areas as $value)
            <option value="{{ $value->id }}">{{ $value->area_name }}</option>
          @endforeach
          </select>
      </div>
      <div class="form-group">
          <label>プロフィール</label><br>
          <textarea name="profile">{{ $user->profile }}</textarea>
      </div>
      <input type="submit" value="更新する">
      @endif
  </form>
  <a href="{{ url('/') }}">トップページに戻る</a>
</main>
@endsection