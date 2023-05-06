export function like(postId) {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
  
  fetch(`/like/${postId}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": csrfToken,
    },
  })
    .then(() => {
      location.reload();
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
    .then(() => {
      location.reload();
    })
    .catch((error) => {
      console.log(error);
    });
} 
