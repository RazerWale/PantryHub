<?php $title = "Profile"; ?>

<?php /*require_once('profileTemplate.php')*/ ?>


<?php ob_start() ?>

<!--<link rel="stylesheet" href="path to the file">-->
<link rel="stylesheet" href="views/css/profile.css">
<style>

</style>

<?php $style = ob_get_clean() ?>

<?php ob_start() ?>
<main class="liked-recommended-container">
    <div class="liked-recommend-buttons"><button class="recommend-button">Searched Recipes</button><button class="liked-button">Liked Recipes</button></div>
    <div class="liked-recommend">
        <div class="recommended-recipes">
            <?php
            /** @var RecipeEntity $recipe */
            foreach ($recipes as $recipe) { ?>
                <div class="rec-recipe">

                    <img src="https://spoonacular.com/recipeImages/<?= $recipe->getId() ?>-480x360.jpg" alt="">
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
                    <ul class="recipe-ingredients">
                        <li><a href="#">Ingredients</a>
                            <ul class="dropdown">
                                <?php foreach ($recipe->getIngredients() as $ingredient) { ?>
                                    <li class="ingredient"><?= $ingredient->getName() ?></li>

                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>

            <?php } ?>


        </div>
        <!--<div class="liked-recipes">
            <div class="liked-recipe">
                <img src="https://spoonacular.com/recipeImages/636589-636x393.jpg" alt="">
                <div class="recipe-links">
                    <img src="images/heart.svg" alt="">
                    <img src="images/share.svg" alt="">
                    <img src="images/timer.svg" alt="">
                </div>
                <a href="#">Butternut Squash Frittata</a>
                <div class="recipe-ingredients">
                    <div class="ingredients-needed">butter, nuts, squash</div>
                    <div class="ingredients-owned">eggs, milk, chicken</div>
                </div>
            </div>
        </div>-->
    </div>
</main>


<?php /*ob_start()*/ ?>


<?php $content = ob_get_clean() ?>


<?php ob_start() ?>


<script src='path to the file'>
    /* JScript for this page is here! */
</script>

<?php $script = ob_get_clean() ?>

<?php require_once('template.php') ?>