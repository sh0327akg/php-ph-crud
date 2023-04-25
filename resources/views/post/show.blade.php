<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          詳細ページ
      </h2>
  </x-slot>

  <x-message :message="session('message')"/>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 sm:p-8">
      <div class="px-10 mt-4">
        <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
          <div class="mt-4">
            <h1 class="text-lg text-gray-700 font-semibold">
                {{ $post->title }}
            </h1>
            <hr class="w-full">
        </div>
        @auth
          @if(Auth::user()->id == $post->user_id)
            <div class="flex justify-end mt-4">
                <a href="{{route('post.edit', $post)}}"><x-primary-button class="bg-teal-700 float-right">編集</x-primary-button></a>
                <form method="post" action="{{ route('post.destroy', $post) }}">
                @csrf
                @method('delete')
                    <x-primary-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
                </form>
            </div>
          @endif
        @endauth
        <div>
          <p class="mt-4 text-gray-600 py-4 whitespace-pre-line">{{$post->body}}</p>
          @if($post->image)
            <img src="{{ $post->image }}" class="mx-auto w-fit" style="max-width: 400px; width: 100%; height: auto;">
          @endif
          <div class="text-sm font-semibold flex flex-row-reverse">
              <p>by {{ $post->user->name }} | {{ $post->created_at->format('Y年m月d日') }}</p>
          </div>
        </div>
      </div>
      <div class="w-full">
        <a href="{{ route('post.index') }}" class="mt-4 inline-flex px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
          一覧に戻る
        </a>
      </div>
    </div>
    
  </div>
</x-app-layout>