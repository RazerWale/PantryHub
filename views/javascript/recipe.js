const favoriteRecipe = document.querySelector(".favourite-recipe");

favoriteRecipe.addEventListener("click", (e) => {
  const urlParams = new URLSearchParams(window.location.search);
  const recipeId = urlParams.get("id");
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
