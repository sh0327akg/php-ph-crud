<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      文章生成ヘルプ
    </h2>
  </x-slot>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <form action="{{ route('help.generateText') }}" method="post">
    @csrf
      <div class="md:flex items-center mt-8">
        <div class="w-full flex flex-col">
          <label for="keywords" class="font-semibold leading-none my-4">キーワード (スペースかカンマで区切る)</label>
          <input type="text" class="form-control w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="keywords" name="keywords" placeholder="例: 塩らーめん, おいしい, また行きたい">
        </div>
      </div>
      <x-primary-button class="mt-4">
        文章を生成
      </x-primiary-button>
    </form>

    @if(!empty($generatedText))
      <div class="mt-4">
        <p class="mb-5 font-semibold">生成された文章</p>
        <p>{{ $generatedText }}</p>
        <button class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150" data-text="{{ $generatedText }}" onclick="copyToClipboard(this)">文章をコピー</button>
      </div>
    @endif
  </div>
</x-app-layout>
