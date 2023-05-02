<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      マイページ
    </h2>
  </x-slot>
  <section class="text-gray-600 body-font">
    <div class="container px-5 mx-auto flex flex-col">
      <div class="mx-auto">
        <div class="sm:flex-row mt-10">
          <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
            <div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </div>
            <div class="flex flex-col items-center text-center justify-center">
              <h2 class="font-medium title-font mt-4 text-gray-900 text-lg">{{ $user->name }}</h2>
              <div class="w-12 h-1 bg-orange-500 rounded mt-2 mb-4"></div>
            </div>
            <div><p class="mb-4">投稿数: {{ $posts->count() }}</p></div>
          </div>
          <div class="font-semibold text-xl mt-4 pt-4 sm:mt-0 text-center">
            <h2>my投稿一覧</h2>
            <div class="mx-auto px-4 py-4 flex flex-wrap sm:px-6 lg:px-8">
              @foreach($posts as $post)
              <div class="p-4 w-full md:w-1/3 text-left">
                <a href="{{ route('post.show', $post)}}">
                  <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden bg-white hover:shadow-lg">
                    <div class="lg:h-60 md:h-36 w-full overflow-hidden object-fill">
                      @if($post->image)
                        <img src="{{ $post->image }}" class="mx-auto object-center">
                      @else
                        <img src="{{ asset('images/default.jpg') }}" class="mx-auto object-center">
                      @endif
                    </div>
                      <div class="p-6">
                        <h1 class="ext-lg text-gray-700 font-semibold hover:underline cursor-pointer">{{ $post->title }}</h1>
                        <hr class="w-full">
                        <p class="text-base leading-relaxed my-3 overflow-hidden" style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3; max-height: 4.5em;">{{ \Illuminate\Support\Str::limit($post->body, 100) }}</p>
                        <span class="mt-3 text-sm font-semibold text-gray-600">
                          <p>{{ $post->created_at->format('Y年m月d日')}}</p>
                        </span>
                      </div>
                  </div>
                </a>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>