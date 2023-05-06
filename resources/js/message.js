document.addEventListener('DOMContentLoaded', () => {
  const messageElement = document.querySelector('.message-timer');

  if (messageElement) {
    setTimeout(() => {
      messageElement.style.display = 'none';
    }, 3000);
  }
});
