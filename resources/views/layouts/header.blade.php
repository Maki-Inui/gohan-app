<header class="pt-1 bg-gradient-to-r flex justify-between">
	<h1 class="ml-6 text-gray-500 font-mono text-4xl">ご飯アプリ</h1>
	<nav class="mr-6 mt-6">
		<ul class="flex">
	　<li class="text-gray-500"><a href="{{ url('/') }}">トップ</a></li>
		@can('isAdmin')
		<li class="text-gray-500 ml-4"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">マイページ</a></li>
		<li class="text-gray-500 ml-4"><a href="{{ route('mypage.visit.index', Auth::id()) }}">行ったお店</a></li>
		<li class="text-gray-500 ml-4"><a href="{{ route('mypage.like.index', Auth::id()) }}">気になるお店</a></li>
		@endcan
		<li class="text-gray-500 ml-4"><a href="{{ route('shops.index') }}">お店一覧</a></li>
	</ul>
	</nav>
</header>