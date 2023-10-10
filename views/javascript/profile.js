let count = 1;
let end = false;
const search = document.getElementById("search");
const searchOutput = document.querySelector(".search-output");
const searchResultDivs = document.querySelectorAll(".search-result-div");
const searchParams = new URLSearchParams(window.location.search);
const likeBtn = document.querySelectorAll(".like-button");

const searchInput = document.getElementById("search");
searchInput.addEventListener("input", (e) => {
  searchOutput.innerHTML = "";
  if (searchInput.value.length >= 3) {
    const xhr = new XMLHttpRequest();

    if (searchInput.value !== "") {
      xhr.open(
        "GET",
        `index.php?action=searchByLetters&search-input=${searchInput.value}`
      );
      xhr.send();
      xhr.addEventListener("load", (e) => {
        const resMessages = JSON.parse(xhr.responseText);
        addSearchInput(resMessages);
      });
    }
  }
});

searchOutput.addEventListener("click", (e) => {
  const target = e.target;
  if (target.classList.contains("search-result-div")) {
    const searchText = target.textContent;
    search.value = searchText;
  }
});
document.addEventListener("click", (e) => {
  if (e.target !== search) {
    searchOutput.style.display = "none";
  }
  if (e.target === search) {
    searchOutput.style.display = "block";
  }
});

function addSearchInput(resMessages) {
  const searchForm = document.querySelector(".search-form");
  const searchOutput = document.querySelector(".search-output");
  if (resMessages.length === 0) {
    const ingredientNameDiv = document.createElement("li");
    ingredientNameDiv.textContent = "no match found";
    searchOutput.appendChild(ingredientNameDiv);
    return;
  }

  for (let i of resMessages) {
    if (i.hasOwnProperty("ingredient_name")) {
      const ingredientName = i["ingredient_name"];
      const ingredientNameDiv = document.createElement("li");
      ingredientNameDiv.classList.add("search-result-div");
      ingredientNameDiv.textContent = ingredientName;

      searchOutput.appendChild(ingredientNameDiv);
    }
    if (i.hasOwnProperty("recipe_name")) {
      const recipeName = i["recipe_name"];

      const recipeNameDiv = document.createElement("li");
      recipeNameDiv.classList.add("search-result-div");
      recipeNameDiv.textContent = recipeName;

      searchOutput.appendChild(recipeNameDiv);
    }
  }
}

document
  .querySelector(".search-container")
  .addEventListener("scroll", function () {
    const contentContainer = this;
    if (searchParams.has("action", "addUserFavouriteRecipes")) {
      return;
    }
    if (
      contentContainer.scrollTop + contentContainer.clientHeight >=
        contentContainer.scrollHeight &&
      !end
    ) {
      count++;
      fetchRecipes(count);
    }
  });

function fetchRecipes(count) {
  let url = `index.php?action=profilePageJson&page=${count}`;
  const xhr = new XMLHttpRequest(); 
  if (searchParams.has("search-item")) {
    url = `index.php?action=searchPageJson&page=${count}&search-item=${searchParams.get(
      "search-item"
    )}`;
  }
  xhr.open("GET", url); 
  xhr.send(); 
  xhr.addEventListener("load", (e) => {
    const resMessages = JSON.parse(xhr.responseText);
    if (resMessages.length == 0) {
      end = true;
    }
    addRecipes(resMessages);
  });
}

function addRecipes(resMessages) {
  const recommendedRecipes = document.querySelector(".recommended-recipes");

  for (const recipe of resMessages) {
    const recipeId = recipe["id"];
    const recipeName = recipe["name"];
    const recipeIngredients = recipe["ingredients"];

    const recName = document.createElement("a");
    recName.classList.add("recipe-name");
    recName.setAttribute("href", `?action=recipePage&id=${recipeId}`);
    recName.textContent = recipeName;

    const recRecipe = document.createElement("div");
    recRecipe.classList.add("rec-recipe");

    const img = document.createElement("img");
    img.setAttribute(
      "src",
      `https://spoonacular.com/recipeImages/${recipeId}-240x150.jpg`
    );

    const ul = document.createElement("ul");
    ul.classList.add("recipe-ingredients");

    const li = document.createElement("li");
    const a = document.createElement("a");
    a.textContent = "Ingredients";

    const ulDropdown = document.createElement("ul");
    ulDropdown.classList.add("dropdown");
    li.appendChild(a);
    li.appendChild(ulDropdown);
    ul.appendChild(li);

    for (const ingr of recipeIngredients) {
      const ingredientName = ingr["name"];
      const ingredient = document.createElement("li");
      ingredient.classList.add("ingredient");
      ingredient.textContent = ingredientName;
      ulDropdown.appendChild(ingredient);
    }

    recRecipe.appendChild(img);
    recRecipe.appendChild(recName);
    recRecipe.appendChild(ul);
    recommendedRecipes.appendChild(recRecipe);
  }
}

if (searchParams.has("action", "addUserFavouriteRecipes")) {
  let likedBtn = document.querySelector(".liked-button");
  let recBtn = document.querySelector(".recommend-button");
  likedBtn.style.backgroundColor = "var(--main-font-color)";
  likedBtn.style.color = "white";
  recBtn.style.backgroundColor = "#F7F4EF";
  recBtn.style.color = "var(--main-font-color)";
}

for (let btn of likeBtn) {
  btn.addEventListener("click", (e) => {
    const recipeId = btn.getAttribute("recipe-id");
    if (btn.classList.contains("liked")) {
      const xhr = new XMLHttpRequest();
      xhr.open(
        "POST",
        `index.php?action=removeFavouriteRecipe&recipeId=${recipeId}`
      );
      xhr.send();
      btn.classList.replace("liked", "not-liked");
    } else if (btn.classList.contains("not-liked")) {
      const xhr = new XMLHttpRequest();
      xhr.open(
        "POST",
        `index.php?action=addUserFavouriteRecipe&recipeId=${recipeId}`
      );
      xhr.send();
      btn.classList.replace("not-liked", "liked");
    }
  });
}
