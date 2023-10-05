const favoriteRecipe = document.querySelector(".favourite-recipe");
const rating = document.querySelector(".rating");
const ratingBtn = document.querySelectorAll(".radio-button");
const urlParams = new URLSearchParams(window.location.search);
const recipeId = urlParams.get("id");

favoriteRecipe.addEventListener("click", (e) => {
  if (favoriteRecipe.classList.contains("liked")) {
    const xhr = new XMLHttpRequest();
    xhr.open(
      "POST",
      `index.php?action=removeFavouriteRecipe&recipeId=${recipeId}`
    );
    xhr.send();
    favoriteRecipe.classList.replace("liked", "not-liked");
  } else if (favoriteRecipe.classList.contains("not-liked")) {
    const xhr = new XMLHttpRequest();
    xhr.open(
      "POST",
      `index.php?action=addUserFavouriteRecipe&recipeId=${recipeId}`
    );
    xhr.send();
    favoriteRecipe.classList.replace("not-liked", "liked");
  }
});
rating.addEventListener("change", (e) => {
  for (let btn of ratingBtn) {
    const ratingInt = btn.value;
    if (btn.checked) {
      console.log("you gave a rating to this recipe!", btn.value);
      const xhr = new XMLHttpRequest();
      xhr.open(
        "POST",
        `index.php?action=addOrUpdateRecipeRating&recipeId=${recipeId}`
      );
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(`recipeRating=${ratingInt}`);
      btn.checked = false;
    }
  }
});
