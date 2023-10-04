<?php $title = "Recipe"; ?>

<?php /*require_once('profileTemplate.php')*/ ?>


<?php ob_start() ?>

<!--<link rel="stylesheet" href="path to the file">-->
<link rel="stylesheet" href="views/css/recipe.css">
<style>
    /* CSS for this page is here! */
</style>

<?php $style = ob_get_clean() ?>




<?php ob_start() ?>
<main class="recipe-container">
    <h1>
        <?= $recipe->getName() ?>
    </h1>
    <div class="info-btn-container"><img class="like-recipe" src="images/heart.svg" alt="">
        <img class="timer-recipe" src="images/timer.svg" alt="">
        <img class="star-recipe" src="images/star.svg" alt="">
    </div>
    <img src="https://spoonacular.com/recipeImages/<?= $recipe->getId() ?>-636x393.jpg" alt="">
    <div class="tags">
        <?php if ($recipe->getDiets() !== null) {
            foreach ($recipe->getDiets() as $diet) { ?>
                <button class="tag">
                    <?= $diet ?>
                </button>
        <?php }
        } ?>
    </div>
    <div class="recipe-ingredients">
        <div class="in-kitchen-container">
            <h3>Appliances</h3>
            <div class="recipe-appliances">

            </div>
        </div>
        <div class="to-buy-container">
            <h3>Ingredients</h3>
            <div class="to-buy">
                <?php foreach ($ingredientsUserHave as $ingredient) { ?>
                    <p class="green">
                        <span class="ingredient-have-name"><?= $ingredient->getName() ?><span>
                                <span class="units">
                                    <?= $ingredient->getQuantityMetric() ?>
                                    <?= $ingredient->getUnitMetric() ?>
                                </span>
                    </p>

                <?php } ?>
                <!--<hr>-->
                <?php foreach ($ingredientsUserHaveNot as $ingredient) { ?>
                    <p class="">
                        <span class="ingredient-dont-have-name"><?= $ingredient->getName() ?></span>
                        <span class="units">
                            <?= $ingredient->getQuantityMetric() ?>
                            <?= $ingredient->getUnitMetric() ?>
                        </span>
                    </p>

                <?php } ?>
            </div>
        </div>
    </div>
    <!-- <div class="recipe-link-container">
        <div class="recipe-links">
            <img src="images/heart.svg" alt="">
            <img src="images/share.svg" alt="">-->
    <!-- <img src="images/timer.svg" alt="">
        </div>
    </div> -->
    <div class="directions">
        <h3>Directions</h3>
        <ol>
            <?php foreach ($recipe->getSteps() as $step) { ?>
                <!--<div class="">
                        <?= $step->getStepNumber() ?>
                    </div>-->
                <li class="">
                    <p>
                        <?= $step->getDescription() ?>
                    </p>
                </li>
            <?php } ?>
        </ol>

    </div>
</main>

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>


<script src='path to the file'>
    /* JScript for this page is here! */
</script>

<?php $script = ob_get_clean() ?>

<?php require_once('template.php')
?>