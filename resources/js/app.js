import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
document.addEventListener('DOMContentLoaded', () => {
  const starRatings = document.querySelectorAll('.star-rating');
  
  starRatings.forEach(rating => {
    rating.addEventListener('click', (e) => {
      const target = e.target;
      
      if (!target.classList.contains('fa-star')) return;
      
      const stars = rating.querySelectorAll('.fa-star');
      const selectedIndex = [...stars].indexOf(target);
      
      stars.forEach((star, index) => {
        if (index <= selectedIndex) {
          star.classList.remove('far');
          star.classList.add('fas');
        } else {
          star.classList.remove('fas');
          star.classList.add('far');
        }
      });
      
      const satisfactionInput = rating.querySelector('input[name="satisfaction"]');
      satisfactionInput.value = selectedIndex + 1;
    });
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const messageElement = document.querySelector('.message-timer');

  if (messageElement) {
    setTimeout(() => {
      messageElement.style.display = 'none';
    }, 3000);
  }
});