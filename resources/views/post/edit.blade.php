<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          投稿の編集
      </h2>
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 sm:p-8">
      <x-validation-errors class="mb-4" :errors="$errors"/>
      <form method="post" action="{{route('post.update', $post)}}" enctype="multipart/form-data">
      @csrf
      @method('patch')
        <div class="md:flex items-center mt-8">
          <div class="w-full flex flex-col">
          <label for="body" class="font-semibold leading-none mt-4">タイトル</label>
          <input type="text" name="title" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('title',$post->title)}}" placeholder="Enter Title">
          </div>
        </div>

        <div class="w-full flex flex-col">
          <label for="body" class="font-semibold leading-none mt-4">本文</label>
          <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('body',$post->body)}}</textarea>
        </div>

        <div class="w-full flex flex-col">
          @if($post->image)
            <div>
              画像ファイル：
            </div>
            <img src="{{ $post->image }}" class="mx-auto" style="height:300px;">
          @endif
          <label for="image" class="font-semibold leading-none mt-4">画像（1MBまで）</label>
          <div>
          <input id="image" type="file" name="image">
          </div>
        </div>

        <x-primary-button class="mt-4">
          編集する
        </x-primiary-button>
        <a href="{{ route('post.show', $post) }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
          キャンセル
        </a>
          
      </form>
    </div>
  </div>

</x-app-layout>
