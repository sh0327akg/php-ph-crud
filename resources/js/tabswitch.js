export function switchTab(tab) {
  if (tab === '自分の投稿') {
    document.getElementById('my-posts').classList.remove('hidden');
    document.getElementById('liked-posts').classList.add('hidden');
    document.getElementById('my-posts-tab').classList.add('border-orange-500', 'text-gray-900');
    document.getElementById('liked-posts-tab').classList.remove('border-orange-500', 'text-gray-900');
  } else if (tab === 'いいね一覧') {
    document.getElementById('my-posts').classList.add('hidden');
    document.getElementById('liked-posts').classList.remove('hidden');
    document.getElementById('my-posts-tab').classList.remove('border-orange-500', 'text-gray-900');
    document.getElementById('liked-posts-tab').classList.add('border-orange-500', 'text-gray-900');
  }
}
