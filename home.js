document.addEventListener("DOMContentLoaded", function() {
  const toggleButton = document.getElementById("toggleReviews");
  const reviews = document.querySelectorAll(".review");

  let reviewsVisible = true;

  toggleButton.addEventListener("click", function() {
    reviewsVisible = !reviewsVisible;

    reviews.forEach(review => {
      review.style.display = reviewsVisible ? "block" : "none";
    });

    toggleButton.textContent = reviewsVisible ? "Hide Reviews" : "Show Reviews";
  });
});
