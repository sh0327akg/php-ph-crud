export function copyToClipboard(button) {
  const text = button.dataset.text;
  navigator.clipboard.writeText(text)
    .then(() => {
      alert('文章がクリップボードにコピーされました');
    })
    .catch((err) => {
      console.error('コピーに失敗しました: ', err);
    });
}