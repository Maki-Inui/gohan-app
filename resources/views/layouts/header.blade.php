<header class="py-4 px-6 flex justify-between items-center">
	<a href="{{ url('/') }}">
	<div class="flex items-center">
		<div class="w-12">
			<img src="{{ asset('image/spoon-fork.png') }}" alt="ロゴ">
		</div>
		<p class="ml-2 text-gray-500 text-4xl transition duration-300 hover:text-black">ご飯アプリ</p>
	</div>
	</a>
	<nav class="mr-6 mt-6">
		<ul class="flex">
		　<li class="menu border-l-2 pl-4"><a href="{{ url('/') }}">トップ</a></li>
			@auth
			<li class="menu ml-4"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">マイページ</a></li>
			<li class="menu ml-4"><a href="{{ route('mypage.visit.index', Auth::id()) }}">行ったお店</a></li>
			<li class="menu ml-4"><a href="{{ route('mypage.like.index', Auth::id()) }}">気になるお店</a></li>
			@endauth
			<li class="menu ml-4"><a href="{{ route('shops.index') }}">お店一覧</a></li>
		</ul>
	</nav>
</header>