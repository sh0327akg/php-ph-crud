<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          投稿一覧
      </h2>

      <x-message :message="session('message')" />

  </x-slot>

  {{-- 投稿一覧表示カード --}}
  <div class="max-w-7xl mx-auto px-4 flex flex-wrap sm:px-6 lg:px-8">
    @foreach ($posts as $post)
      <div class="p-4 md:w-1/3">
        <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden">
          <div class="lg:h-48 bg-gray-400 md:h-36 w-full object-cover object-center">
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
      </div>
    @endforeach
  </div>
</x-app-layout>