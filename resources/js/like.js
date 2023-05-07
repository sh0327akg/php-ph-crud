function updateDOM(postId, liked) {
  const heartIcon = document.querySelector(`#heart-${postId}`);
  if (liked) {
    heartIcon.classList.remove("text-gray-400");
    heartIcon.classList.add("text-pink-500");
    heartIcon.setAttribute("onclick", `unlike(${postId})`);
  } else {
    heartIcon.classList.remove("text-pink-500");
    heartIcon.classList.add("text-gray-400");
    heartIcon.setAttribute("onclick", `like(${postId})`);
  }
}

function updateLikeCount(postId, increment) {
  const likeCountElement = document.getElementById(`like-count-${postId}`);
  const currentCount = parseInt(likeCountElement.textContent.match(/\d+/)[0]);
  const newCount = increment ? currentCount + 1 : currentCount - 1;
  likeCountElement.textContent = `${newCount}`;
}


export function like(postId) {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
  
  fetch(`/like/${postId}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": csrfToken,
    },
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.result === "success") {
        updateDOM(postId, true);
        updateLikeCount(postId, true);
      }
    })
    .catch((error) => {
      console.log(error);
    });
}

export function unlike(postId) {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
  
  fetch(`/unlike/${postId}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": csrfToken,
    },
    body: JSON.stringify({
      _method: "DELETE",
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.result === "success") {
        updateDOM(postId, false);
        updateLikeCount(postId, false);
      }
    })
    .catch((error) => {
      console.log(error);
    });
} 
