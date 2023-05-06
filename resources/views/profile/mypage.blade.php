<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      マイページ
    </h2>
  </x-slot>
  <section class="text-gray-600 body-font">
    <div class="container px-5 mx-auto flex flex-col justify-center">
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
            <div><p class="mb-4">投稿数: {{ $posts->total() }}</p></div>
          </div>

          <!-- タブナビゲーション -->
          <div class="mt-6">
            <div class="border-b border-gray-200">
              <nav class="-mb-px flex space-x-8">
                <button id="my-posts-tab" class="border-orange-500 text-gray-900 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none" onclick="switchTab('自分の投稿')">
                  自分の投稿
                </button>
                <button id="liked-posts-tab" class="text-gray-500 hover:text-gray-700 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none" onclick="switchTab('いいね一覧')">
                  いいね一覧
                </button>
              </nav>
            </div>
          </div>

          <div class="font-semibold text-xl mt-4 pt-4 sm:mt-0">
            <!-- 自分の投稿 -->
            <div id="my-posts" class="mx-auto px-4 py-4 flex flex-wrap sm:px-6 lg:px-8">
              @if($posts->isEmpty())
                <p>投稿がありません</p>
              @endif
              @foreach($posts as $post)
                <x-post-card :post="$post" />
              @endforeach
              <div class="w-full mt-4">
                {{ $posts->links() }}
              </div>
            </div>

            <!-- いいね一覧 -->
            <div id="liked-posts" class="hidden">
              <div class="mx-auto px-4 py-4 flex flex-wrap sm:px-6 lg:px-8">
                @if($liked_posts->isEmpty())
                  <p>いいねした投稿がありません</p>
                @endif
                @foreach($liked_posts as $post)
                  <x-post-card :post="$post" />
                @endforeach
                <div class="w-full mt-4">
                  {{ $liked_posts->links() }}
                </div>
              </div>
            </div>
          </div>

      </div>
    </div>
  </section>
</x-app-layout>