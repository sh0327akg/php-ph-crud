<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        投稿一覧
    </h2>
    {{-- 検索フォーム --}}
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
      <form method="GET" action="{{ route('post.index') }}" class="mb-4 items-center">
          <input type="text" name="search" placeholder="キーワードを入力" class="border border-gray-300 w-full md:mr-2 mb-2 md:mb-0" value="{{ request()->input('search') }}">
          <button type="submit" class="bg-orange-600 text-white mt-3 px-6 py-2 w-full md:w-auto">検索</button>
      </form>
    </div>
  </x-slot>
  {{-- 検索ワード表示 --}}
  @if(request()->input('search'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
      <p>検索ワード: <strong>{{ request()->input('search') }}</strong></p>
    </div>
  @endif
  <x-message :message="session('message')" />
  {{-- 投稿一覧表示カード --}}
  <div class="max-w-7xl mx-auto px-4 flex flex-wrap sm:px-6 lg:px-8">
    @foreach ($posts as $post)
      <x-post-card :post="$post" />
    @endforeach
  </div>
  <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
    {{ $posts->links() }}
  </div>
</x-app-layout>