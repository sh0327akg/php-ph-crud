<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          投稿の新規作成
      </h2>
  </x-slot>

  <x-message :message="session('message')"/>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 sm:p-8">
      <x-validation-errors class="mb-4" :errors="$errors"/>
      <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
      @csrf
        <div class="md:flex items-center mt-8">
          <div class="w-full flex flex-col">
          <label for="body" class="font-semibold leading-none mt-4">タイトル</label>
          <input type="text" name="title" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('title')}}" placeholder="Enter Title">
          </div>
        </div>

        <div class="w-full flex flex-col">
          <label for="body" class="font-semibold leading-none mt-4">本文</label>
          <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('body')}}</textarea>
        </div>

        <div class="flex flex-col w-full">
          <label for="genre" class="font-semibold leading-none mt-4">ベース</label>
          <select name="genre" id="genre" class="w-auto py-2 border border-gray-300 rounded-md">
            <option value="">選択してください</option>
            <option value="塩" {{ old('genre') === '塩' ? 'selected' : ''}}>塩</option>
            <option value="醤油" {{ old('genre') === '醤油' ? 'selected' : ''}}>醤油</option>
            <option value="味噌" {{ old('genre') === '味噌' ? 'selected' : ''}}>味噌</option>
            <option value="とんこつ" {{ old('genre') === 'とんこつ' ? 'selected' : ''}}>とんこつ</option>
            <option value="その他"  {{ old('genre') === 'その他' ? 'selected' : ''}}>その他</option>
          </select>
        </div>

        <div class="w-full flex flex-col">
          <label for="image" class="font-semibold leading-none mt-4">画像（1MBまで）</label>
          <div>
          <input id="image" type="file" name="image">
          </div>
        </div>

        <div class="w-full flex flex-col">
          <label for="satisfaction" class="font-semibold leading-none mt-4">満足度（5段階）</label>
          <div class="star-rating  hover:cursor-pointer">
            @for($i = 1; $i <= 5; $i++)
              <i class="fa-star far {{ old('satisfaction') >= $i ? 'fas' : '' }}"></i>
            @endfor
            <input type="hidden" name="satisfaction" value="{{ old('satisfaction') }}">
          </div>
        </div>

        <x-primary-button class="mt-4">
          送信する
        </x-primiary-button>
          
      </form>
    </div>
  </div>

</x-app-layout>
