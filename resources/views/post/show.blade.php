<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          詳細ページ
      </h2>
  </x-slot>

  <x-message :message="session('message')"/>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 p-8">
      <div class="bg-white w-full rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500 relative">
        <h1 class="text-xl text-gray-700 font-semibold">{{ $post->title }}</h1>
        <hr class="w-full">
        <p class="text-base">ベース：<strong>{{ $post->genre }}</strong></p>
        <div class="flex flex-wrap">
          <h3 class="text-base mr-3">満足度:</h3>
          <div class="rating">
            @for($i = 1; $i <= 5; $i++)
              <i class="fa-star {{ $post->satisfaction >= $i ? 'fas' : 'far' }} text-sm sm:text-base"></i>
            @endfor
          </div>
        </div>
        
        @auth
          @if(Auth::user()->id == $post->user_id)
            <div class="flex justify-end mt-4">
              <a href="{{route('post.edit', $post)}}"><x-primary-button class="bg-teal-700">編集</x-primary-button></a>
              <form method="post" action="{{ route('post.destroy', $post) }}" class="ml-4">
              @csrf
              @method('delete')
                <x-primary-button class="bg-red-700" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
              </form>
            </div>
          @endif
        @endauth
        
        <p class="mt-4 text-gray-600 py-4 whitespace-pre-line">{{$post->body}}</p>
        
        @if($post->image)
          <img src="{{ $post->image }}" class="mx-auto w-full md:w-fit" style="max-width: 400px; width: 100%; height: auto;">
        @endif

        <div class="cursor-pointer p-2 rounded-full bg-gray-100 hover:bg-gray-200 inline-flex items-center justify-center">
          @if (!Auth::user()->is_like($post->id))
          <i id="heart-{{$post->id}}" class="fas fa-heart text-gray-400" onclick="like({{$post->id}})"></i>
          @else
          <i id="heart-{{$post->id}}" class="fas fa-heart text-pink-500" onclick="unlike({{$post->id}})"></i>
          @endif
        </div>
        <div class="m-4 inline-block">
          <span id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>
        </div>
        
        <div class="text-sm font-semibold mt-4 text-gray-400">
          <p>by <a href="{{ route('profile.show', $post->user->id)}}" class="hover:underline">{{ $post->user->name }}</a> | {{ $post->created_at->format('Y年m月d日') }}</p>
        </div>
      </div>
        
      <div class="w-full mt-4">
        <a href="{{ route('post.index') }}" class="inline-flex px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
          一覧に戻る
        </a>
      </div>
    </div>
  </div>


</x-app-layout>