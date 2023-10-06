<?php $title = "Profile"; ?>

<?php /*require_once('profileTemplate.php')*/?>


<?php ob_start() ?>

<!--<link rel="stylesheet" href="path to the file">-->
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
                Searched Recipes
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
                    <img class="like-button" src="images/heart.svg" alt="">

                    <img class="recipe-img" src="https://spoonacular.com/recipeImages/<?= $recipe->getId() ?>-240x150.jpg"
                        alt="">
                    <!--<div class="recipe-link-container">
                        <div class="recipe-links">
                            <img src="images/heart.svg" alt="">
                            <img src="images/share.svg" alt="">
                            <img src="images/timer.svg" alt="">
                        </div>
                    </div>-->
                    <a class="recipe-name" href="?action=recipePage&id=<?= $recipe->getId() ?>">
                        <?= $recipe->getName() ?>
                    </a>
                    <div class="time"><img src="images/timer.svg" alt=""><span>min.</span></div>
                    <ul class="recipe-ingredients">
                        <!-- <li> -->
                        <!-- <a href="#">Ingredients</a> -->
                        <!-- <ul class="dropdown"> -->
                        <?php foreach ($recipe->getIngredients() as $ingredient) { ?>
                            <li class="ingredient">
                                <?= $ingredient->getName() ?>,
                            </li>

                        <?php } ?>
                        <!-- </ul> -->
                        <!-- </li> -->
                    </ul>
                    <!-- <div class="recipe-misc-container">
                        <div class="recipe-info">
                            <img src="images/heart.svg" alt="">
                            <img src="images/share.svg" alt="">
                            <img src="images/timer.svg" alt="">
                        </div>
                    </div> -->
                </div>

            <?php } ?>


        </div>
    </div>
</main>


<?php /*ob_start()*/?>


<?php $content = ob_get_clean() ?>


<?php ob_start() ?>


<script src='views/javascript/profile.js'>
    /* JScript for this page is here! */
</script>

<?php $script = ob_get_clean() ?>

<?php require_once('template.php') ?>