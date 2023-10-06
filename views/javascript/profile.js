let count = 1;
let end = false;
const search = document.getElementById("search");
const searchOutput = document.querySelector(".search-output");
const searchResultDivs = document.querySelectorAll(".search-result-div");

const searchInput = document.getElementById("search");
searchInput.addEventListener("input", (e) => {
  const xhr = new XMLHttpRequest();
  searchOutput.innerHTML = "";

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
  // .querySelector(".liked-recommend")
  .addEventListener("scroll", function () {
    const contentContainer = this;
    if (
      contentContainer.scrollTop + contentContainer.clientHeight >=
        contentContainer.scrollHeight &&
      !end
    ) {
      count++;
      console.log("you suck!");
      fetchRecipes(count);
    }
  });

function fetchRecipes(count) {
  const searchParams = new URLSearchParams(window.location.search);
  let url = `index.php?action=profilePageJson&page=${count}`;
  const xhr = new XMLHttpRequest(); // create the HTTP request
  if (searchParams.has("search-item")) {
    url = `index.php?action=searchPageJson&page=${count}&search-item=${searchParams.get(
      "search-item"
    )}`;
  }
  xhr.open("GET", url); // open the request with parameter message
  xhr.send(); // send request to the server
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
      `https://spoonacular.com/recipeImages/${recipeId}-480x360.jpg`
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
