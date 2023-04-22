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
      <div class="p-4 w-full md:w-1/3">
        <a href="{{ route('post.show', $post)}}">
          <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden bg-white hover:shadow-lg">
            <div class="lg:h-60 md:h-36 w-full overflow-hidden object-fill">
              @if($post->image)
                <img src="{{ asset('storage/images/'.$post->image) }}" class="mx-auto object-center">
              @else
                <img src="{{ asset('images/default.jpg') }}" class="mx-auto object-center">
              @endif
            </div>
              <div class="p-6">
                <h1 class="ext-lg text-gray-700 font-semibold hover:underline cursor-pointer">{{ $post->title }}</h1>
                <hr class="w-full">
                <p class="leading-relaxed my-3  overflow-hidden">{{ $post->body }}</p>
                <span class="mt-3 text-sm font-semibold text-gray-600">
                  <p>{{ $post->user->name }} | {{ $post->created_at->format('Y年m月d日')}}</p>
                </span>
              </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
  <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
    {{ $posts->links() }}
  </div>
</x-app-layout>