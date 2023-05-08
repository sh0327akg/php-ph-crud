<div class="p-4 w-full md:w-1/3 lg:w-1/3 xl:w-1/3">
  <div class="h-full flex flex-col border-2 border-gray-200 rounded-lg overflow-hidden bg-white hover:shadow-lg">
    <div class="h-48 sm:h-56 md:h-64 lg:h-60 xl:h-72 w-full overflow-hidden object-fill">
      @if($post->image)
        <img src="{{ $post->image }}" class="mx-auto object-center h-full w-full object-cover">
      @else
        <img src="{{ asset('images/default.jpg') }}" class="mx-auto object-center h-full w-full object-cover">
      @endif
    </div>
    <div class="flex-grow p-6">
      <a href="{{ route('post.show', $post)}}">
        <h1 class="ext-lg text-gray-700 font-semibold hover:underline cursor-pointer">{{ $post->title }}</h1>
      </a>
      <hr class="w-full">
      <p class="text-sm leading-relaxed my-3 overflow-hidden" style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3; max-height: 4.5em;">{{ \Illuminate\Support\Str::limit($post->body, 100) }}</p>
    </div>
    <div class="px-6 py-4 sm:flex justify-between items-center">

      <div class="flex justify-end items-center">
        @if (Auth::user()->id !== $post->user_id)
            <div class="cursor-pointer p-2 rounded-full bg-gray-100 hover:bg-gray-200 inline-flex items-center justify-center">
                @if (!Auth::user()->is_like($post->id))
                    <i id="heart-{{$post->id}}" class="fas fa-heart text-gray-400" onclick="like({{$post->id}})"></i>
                @else
                    <i id="heart-{{$post->id}}" class="fas fa-heart text-pink-500" onclick="unlike({{$post->id}})"></i>
                @endif
            </div>
            <span id="like-count-{{ $post->id }}" class="text-sm ml-2">{{ $post->likes->count() }}</span>
        @else
            <div class="cursor-not-allowed p-2 rounded-full bg-gray-300 inline-flex items-center justify-center">
                <i class="fas fa-heart text-gray-400" disabled></i>
            </div>
            <span class="text-sm ml-2">{{ $post->likes->count() }}</span>
        @endif
      </div>

      <span class="text-sm font-semibold text-gray-400">
        <p>
            <a href="{{ route('profile.show', $post->user->id) }}" class="text-gray-400 hover:text-gray-600">
                {{ $post->user->name }}
            </a>
            | {{ $post->created_at->format('Y年m月d日')}}
        </p>
      </span>
    
    </div>
  </div>
</div>
