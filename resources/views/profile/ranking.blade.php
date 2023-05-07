<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      ランキング
    </h2>
  </x-slot>
  <div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
        <div>
          <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-400">
              <tr>
                <th scope="col" class="px-6 py-4">Rank</th>
                <th scope="col" class="px-6 py-4">Name</th>
                <th scope="col" class="px-6 py-4">Contribution<br><span class="text-xs text-gray-400">※獲得いいね＋総満足度</span></th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr class="border-b dark:border-neutral-400">
                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $loop->index + 1 }}</td>
                <td class="whitespace-nowrap px-6 py-4 overflow-hidden">
                  <a href="{{ route('profile.show',$user->id) }}" class="hover:underline">{{ $user->name }}</a>
                </td>
                <td class="whitespace-nowrap px-6 py-4">{{ $user->total_score }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
    {{ $users->links() }}
  </div>
</x-app-layout>