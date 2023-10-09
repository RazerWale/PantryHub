<?php $title = "Profile"; ?>



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
    <div class="liked-recommend-buttons"><button class="recommend-button">Recommended Recipes</button>
        <a class="fave-recipes" href="?action=addUserFavouriteRecipes"><button class="liked-button">Liked Recipes</button></a>
    </div>
    <div class="liked-recommend">
        <div class="recommended-recipes">
            <?php
            /** @var RecipeEntity $recipe */
            foreach ($recipes as $recipe) { ?>
                <div class="rec-recipe">
                    <img class="like-button" src="images/heart.svg" alt="">

                    <img class="recipe-img" src="https://spoonacular.com/recipeImages/<?= $recipe->getId() ?>-240x150.jpg" alt="">

                    <a class="recipe-name" href="?action=recipePage&id=<?= $recipe->getId() ?>">
                        <?= $recipe->getName() ?>
                    </a>
                    <div class="time"><img src="images/timer.svg" alt=""><span>min.</span></div>
                    <ul class="recipe-ingredients">
                        <?php foreach ($recipe->getIngredients() as $ingredient) { ?>
                            <li class="ingredient">
                                <?= $ingredient->getName() ?>,
                            </li>

                        <?php } ?>
                    </ul>
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