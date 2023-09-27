let count = 1;
let end = false;

document
  .querySelector(".search-container")
  .addEventListener("scroll", function () {
    const contentContainer = this;
    if (
      contentContainer.scrollTop + contentContainer.clientHeight >=
        contentContainer.scrollHeight &&
      !end
    ) {
      console.log(count);
      count++;
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

  for (let i in resMessages) {
    const recipeId = resMessages[i]["id"];
    const recipeName = resMessages[i]["name"];
    const recipeIngredients = resMessages[i]["ingredients"];

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

    for (let i in recipeIngredients) {
      const ingredientName = recipeIngredients[i]["name"];
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
