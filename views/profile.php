<?php $title = "PantryHub"; ?>


<?php ob_start() ?>

<link rel="stylesheet" href="views/css/profile.css">
<style>
</style>

<?php $style = ob_get_clean() ?>

<?php ob_start() ?>
<form class="search-form" action="?action=search" method="GET">
    <input type="hidden" name="action" value="search">
    <input type="text" placeholder="Search Here" id="search" name="search-item" autocomplete="off">
    <button type="submit">Search</button>
    <ul class="search-output"></ul>
</form>
<main class="liked-recommended-container">
    <div class="liked-recommend-buttons">
        <a href="?action=profilePage" style="text-decoration:none">
            <button class="recommend-button">
                Recommended Recipes
            </button>
        </a>
        <a href="?action=addUserFavouriteRecipes">
            <button class="liked-button">Liked Recipes</button>
        </a>
    </div>
    <div class="liked-recommend">
        <div class="recommended-recipes">
            <?php
            /** @var RecipeEntity $recipe */
            foreach ($recipes as $recipe) { ?>
                <div class="rec-recipe">
                    <div>
                        <img class="recipe-img" src="https://spoonacular.com/recipeImages/<?= $recipe->getId() ?>-240x150.jpg" alt="">
                    </div>
                    <div class="recipeName">
                        <a class="recipe-name" href="?action=recipePage&id=<?= $recipe->getId() ?>">
                            <?= $recipe->getName() ?>
                        </a>
                    </div>
                    <div class="rating">
                        <div class="count-rating">
                            <?php $recipeManager = new RecipeManager();
                            $recipeRating = $recipeManager->fetchRecipeRating($recipe->getId()) ?>
                            <?= '(' . $recipeRating["count_rating"] . ')' ?>
                        </div>
                        <input type="radio" class="radio-button" name="rating" id="star5" value="5" hidden>
                        <label class="star" for="star5">&#9733;</label>
                        <input type="radio" class="radio-button" name="rating" id="star4" value="4" hidden>
                        <label class="star" for="star4">&#9733;</label>
                        <input type="radio" class="radio-button" name="rating" id="star3" value="3" hidden>
                        <label class="star" for="star3">&#9733;</label>
                        <input type="radio" class="radio-button" name="rating" id="star2" value="2" hidden>
                        <label class="star" for="star2">&#9733;</label>
                        <input type="radio" class="radio-button" name="rating" id="star1" value="1" hidden>
                        <label class="star" for="star1">&#9733;</label>
                    </div>
                    <div class="time">
                        <svg class="timeImg" width="50" height="18" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.28888 12.5C3.89568 16.0752 2.5 20.3747 2.5 25C2.5 37.4265 12.5736 47.5 25 47.5C37.4265 47.5 47.5 37.4265 47.5 25C47.5 12.5736 37.4265 2.5 25 2.5V10M25 25L15 15" stroke="#2D3142" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>
                            <?= $recipe->getTimeToCook() ?> min.
                        </span>
                    </div>
                    <ul class="recipe-ingredients">
                        <?php foreach ($recipe->getIngredients() as $ingredient) { ?>
                            <li class="ingredient">
                                <?= $ingredient->getName() ?>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="likeAndCal">
                        <div class="calories">
                            <?= round($recipe->getCalories(), 0) ?> calories
                        </div>

                        <div class="likeBtnAndRating favourite-recipe">
                            <svg class="like-button 
                            <?php $isRecipeLiked = $recipeManager->isRecipeLiked($userId, $recipe->getId());
                            if ($isRecipeLiked) { ?>
                                <?= 'liked' ?> 
                                <?php } else { ?>
                                <?= 'not-liked' ?> 
                                <?php } ?>
                                " recipe-id=<?= $recipe->getId() ?> width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M30 15.0005C25.5015 9.75792 17.9844 8.13775 12.3481 12.9384C6.7117 17.739 5.91817 25.7652 10.3444 31.443C14.0246 36.1635 25.162 46.1198 28.8122 49.3423C29.2205 49.7028 29.4247 49.883 29.663 49.9538C29.8707 50.0155 30.0982 50.0155 30.3062 49.9538C30.5445 49.883 30.7485 49.7028 31.157 49.3423C34.8072 46.1198 45.9445 36.1635 49.6247 31.443C54.051 25.7652 53.3543 17.6885 47.621 12.9384C41.8878 8.18825 34.4985 9.75792 30 15.0005Z" stroke="#2D3142" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>


<?php $content = ob_get_clean() ?>
<?php ob_start() ?>

<script src='views/javascript/profile.js'>

</script>

<?php $script = ob_get_clean() ?>

<?php require_once('template.php') ?>