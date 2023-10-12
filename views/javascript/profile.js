let count = 1;
let end = false;
const search = document.getElementById("search");
const searchOutput = document.querySelector(".search-output");
const searchResultDivs = document.querySelectorAll(".search-result-div");
const searchParams = new URLSearchParams(window.location.search);
const likeBtnAndRating = document.querySelectorAll(".likeBtnAndRating");
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
    let likeBtnNew = document.querySelectorAll(".like-button");
    for (let btn of likeBtnNew) {
      btn.addEventListener("mouseover", (e) => {
        const recipeId = btn.getAttribute("recipe-id");
      });
    }
    for (let i = 10; i < likeBtnNew.length; i++) {
      likeBtnNew[i].addEventListener("click", (e) => {
        const recipeId = likeBtnNew[i].getAttribute("recipe-id");
        if (likeBtnNew[i].classList.contains("liked")) {
          const xhr = new XMLHttpRequest();
          xhr.open(
            "POST",
            `index.php?action=removeFavouriteRecipe&recipeId=${recipeId}`
          );
          xhr.send();
          likeBtnNew[i].classList.replace("liked", "not-liked");
        } else if (likeBtnNew[i].classList.contains("not-liked")) {
          const xhr = new XMLHttpRequest();
          xhr.open(
            "POST",
            `index.php?action=addUserFavouriteRecipe&recipeId=${recipeId}`
          );
          xhr.send();
          likeBtnNew[i].classList.replace("not-liked", "liked");
        }
      });
    }
  });
}

function addRecipes(resMessages) {
  const recommendedRecipes = document.querySelector(".recommended-recipes");

  for (const recipe of resMessages) {
    const recipeId = recipe["id"];
    const recipeName = recipe["name"];
    const recipeTime = recipe["time"];
    const recipeCalories = recipe["calories"];
    const isLiked = recipe["isLiked"];
    let avgRating = recipe["rating"].average_rating;
    let countRatings = recipe["rating"].count_rating;
    const recipeIngredients = recipe["ingredients"];
    if (avgRating === null) {
      avgRating = 0;
    }

    const recNameDiv = document.createElement("div");
    const recName = document.createElement("a");
    recNameDiv.classList.add("recipeName");
    recNameDiv.setAttribute("title", recipeName);
    recName.classList.add("recipe-name");
    recName.setAttribute("href", `?action=recipePage&id=${recipeId}`);
    recName.textContent = recipeName;

    const rating = document.createElement("div");
    rating.classList.add("rating");
    const countRating = document.createElement("div");
    countRating.classList.add("count-rating");
    countRating.textContent = `(${countRatings})`;

    const recRecipe = document.createElement("div");
    recRecipe.classList.add("rec-recipe");

    const imgDiv = document.createElement("div");
    const img = document.createElement("img");
    img.classList.add("recipe-img");

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

    imgDiv.appendChild(img);
    recRecipe.appendChild(imgDiv);
    recNameDiv.appendChild(recName);
    rating.appendChild(countRating);

    const star5 = createStarRating(recipeId, avgRating, 4.5, 5);
    const star4 = createStarRating(recipeId, avgRating, 3.5, 4);
    const star3 = createStarRating(recipeId, avgRating, 2.5, 3);
    const star2 = createStarRating(recipeId, avgRating, 1.5, 2);
    const star1 = createStarRating(recipeId, avgRating, 0.5, 1);

    const time = createTime(recipeTime);
    const ingredients = createIngredients(recipeIngredients);

    const likeAndCal = createLikeAndCal(recipeCalories, isLiked, recipeId);
    recRecipe.appendChild(recNameDiv);
    rating.appendChild(star5);
    rating.appendChild(star4);
    rating.appendChild(star3);
    rating.appendChild(star2);
    rating.appendChild(star1);
    recRecipe.appendChild(rating);
    recRecipe.appendChild(time);
    recRecipe.appendChild(ingredients);
    recRecipe.appendChild(likeAndCal);
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
document.addEventListener("DOMContentLoaded", (e) => {
  console.log("hello world");
});

function createStarRating(recipeId, averageRating, starHalf, starFull) {
  // Create the container for the stars
  const starsContainer = document.createElement("div");
  const recRecipe = document.querySelector(".rec-recipe");

  starsContainer.classList.add("stars-container");

  // Create the half star label
  const halfStarLabel = document.createElement("label");
  halfStarLabel.classList.add("star", "half");
  halfStarLabel.htmlFor = `${recipeId}-star${starHalf}`;

  // Create the SVG for the half star
  const halfStarSVG = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "svg"
  );
  halfStarSVG.classList.add(
    "halfStar",
    averageRating >= starHalf ? "starFill" : "no"
  );
  halfStarSVG.setAttribute("width", "56");
  halfStarSVG.setAttribute("height", "55");
  halfStarSVG.setAttributeNS(null, "viewBox", "0 0 28 55");
  halfStarSVG.setAttributeNS(null, "fill", "none");
  halfStarSVG.setAttribute("xmlns", "http://www.w3.org/2000/svg");

  // Create the path element for the half star
  const halfStarPath = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "path"
  );
  halfStarPath.setAttributeNS(
    null,
    "d",
    "M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
  );
  halfStarPath.setAttribute("stroke", "#2D3142");
  halfStarPath.setAttribute("stroke-width", "0");
  halfStarPath.setAttribute("stroke-linecap", "round");
  halfStarPath.setAttribute("stroke-linejoin", "round");

  // Append the path to the SVG
  halfStarSVG.appendChild(halfStarPath);

  // Append the SVG to the half star label
  halfStarLabel.appendChild(halfStarSVG);

  // Create the full star label
  const fullStarLabel = document.createElement("label");
  fullStarLabel.classList.add("star", "full");
  fullStarLabel.htmlFor = `${recipeId}-star${starFull}`;

  // Create the SVG for the full star
  const fullStarSVG = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "svg"
  );
  fullStarSVG.classList.add(
    "fullStar",
    averageRating >= starFull ? "starFill" : "no"
  );
  fullStarSVG.setAttribute("width", "56");
  fullStarSVG.setAttribute("height", "55");
  fullStarSVG.setAttributeNS(null, "viewBox", "0 0 56 55");
  fullStarSVG.setAttributeNS(null, "fill", "none");
  fullStarSVG.setAttribute("xmlns", "http://www.w3.org/2000/svg");

  // Create the path element for the full star
  const fullStarPath = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "path"
  );
  fullStarPath.setAttributeNS(
    null,
    "d",
    "M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
  );
  fullStarPath.setAttribute("stroke", "#2D3142");
  fullStarPath.setAttribute("stroke-width", "0");
  fullStarPath.setAttribute("stroke-linecap", "round");
  fullStarPath.setAttribute("stroke-linejoin", "round");

  // Append the path to the SVG
  fullStarSVG.appendChild(fullStarPath);

  // Append the SVG to the full star label
  fullStarLabel.appendChild(fullStarSVG);

  // Create the input elements
  const halfStarInput = document.createElement("input");
  halfStarInput.setAttribute("type", "radio");
  halfStarInput.classList.add("radio-button", "half");
  halfStarInput.name = `rating-${recipeId}`;
  halfStarInput.id = `${recipeId}-star${starHalf}`;
  halfStarInput.value = `${starHalf}`;
  halfStarInput.hidden = true;

  const fullStarInput = document.createElement("input");
  fullStarInput.setAttribute("type", "radio");
  fullStarInput.classList.add("radio-button");
  fullStarInput.name = `rating-${recipeId}`;
  fullStarInput.id = `${recipeId}-star${starFull}`;
  fullStarInput.value = `${starFull}`;
  fullStarInput.hidden = true;

  // Append the elements to the stars container
  halfStarLabel.appendChild(fullStarLabel);
  halfStarLabel.appendChild(fullStarInput);
  starsContainer.appendChild(halfStarLabel);
  starsContainer.appendChild(halfStarInput);

  return starsContainer;
}

function createTime(recipeTime) {
  const timeDiv = document.createElement("div");
  timeDiv.classList.add("time");
  const span = document.createElement("span");

  span.textContent = `${recipeTime} min.`;
  const timeSVG = document.createElementNS("http://www.w3.org/2000/svg", "svg");
  timeSVG.classList.add("timeImg");
  timeSVG.setAttribute("width", "50");
  timeSVG.setAttribute("height", "18");
  timeSVG.setAttributeNS(null, "viewBox", "0 0 50 50");
  timeSVG.setAttributeNS(null, "fill", "none");
  timeSVG.setAttribute("xmlns", "http://www.w3.org/2000/svg");

  // Create the path element for the half star
  const timePath = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "path"
  );
  timePath.setAttributeNS(
    null,
    "d",
    "M6.28888 12.5C3.89568 16.0752 2.5 20.3747 2.5 25C2.5 37.4265 12.5736 47.5 25 47.5C37.4265 47.5 47.5 37.4265 47.5 25C47.5 12.5736 37.4265 2.5 25 2.5V10M25 25L15 15"
  );
  timePath.setAttribute("stroke", "#2D3142");
  timePath.setAttribute("stroke-width", "4");
  timePath.setAttribute("stroke-linecap", "round");
  timePath.setAttribute("stroke-linejoin", "round");

  timeSVG.appendChild(timePath);
  timeDiv.appendChild(timeSVG);
  timeDiv.appendChild(span);
  return timeDiv;
}

function createIngredients(ingredients) {
  const ul = document.createElement("ul");
  ul.classList.add("recipe-ingredients");
  for (const ingredient of ingredients) {
    const li = document.createElement("li");
    li.classList.add("ingredient");
    li.textContent = ingredient.name;
    ul.appendChild(li);
  }
  return ul;
}

function createLikeAndCal(calories, likedOrNot, recipeId) {
  const likeAndCal = document.createElement("div");
  const caloriesDiv = document.createElement("div");
  likeAndCal.classList.add("likeAndCal");
  caloriesDiv.classList.add("calories");
  caloriesDiv.textContent = calories + " calories";
  likeAndCal.appendChild(caloriesDiv);

  const likeBtn = document.createElement("div");
  likeBtn.classList.add("likeBtnAndRating", "favourite-recipe");

  const likeSVG = document.createElementNS("http://www.w3.org/2000/svg", "svg");
  if (likedOrNot) {
    likeSVG.classList.add("like-button", "liked");
  } else {
    likeSVG.classList.add("like-button", "not-liked");
  }
  likeSVG.setAttribute("recipe-id", recipeId);
  likeSVG.setAttribute("width", "60");
  likeSVG.setAttribute("height", "60");
  likeSVG.setAttributeNS(null, "viewBox", "0 0 60 60");
  likeSVG.setAttributeNS(null, "fill", "none");
  likeSVG.setAttribute("xmlns", "http://www.w3.org/2000/svg");

  // Create the path element for the half star
  const likePath = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "path"
  );
  likePath.setAttributeNS(null, "fill-rule", "evenodd");
  likePath.setAttributeNS(null, "clipe-rule", "evenodd");
  likePath.setAttributeNS(
    null,
    "d",
    "M30 15.0005C25.5015 9.75792 17.9844 8.13775 12.3481 12.9384C6.7117 17.739 5.91817 25.7652 10.3444 31.443C14.0246 36.1635 25.162 46.1198 28.8122 49.3423C29.2205 49.7028 29.4247 49.883 29.663 49.9538C29.8707 50.0155 30.0982 50.0155 30.3062 49.9538C30.5445 49.883 30.7485 49.7028 31.157 49.3423C34.8072 46.1198 45.9445 36.1635 49.6247 31.443C54.051 25.7652 53.3543 17.6885 47.621 12.9384C41.8878 8.18825 34.4985 9.75792 30 15.0005Z"
  );
  likePath.setAttribute("stroke", "#2D3142");
  likePath.setAttribute("stroke-width", "3");
  likePath.setAttribute("stroke-linecap", "round");
  likePath.setAttribute("stroke-linejoin", "round");

  likeSVG.appendChild(likePath);
  likeSVG.appendChild(likePath);
  likeBtn.appendChild(likeSVG);
  likeAndCal.appendChild(likeBtn);

  return likeAndCal;
}
// Call the function with your recipe ID and average rating
// const recipeId = "your-recipe-id"; // Replace with your recipe ID
// const averageRating = $recipeRating["average_rating"]; // Replace with your PHP variable

// createStarRating(recipeId, averageRating, starHalf, starFull);
