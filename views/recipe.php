<?php $title = "Recipe"; ?>

<?php ob_start() ?>

<link rel="stylesheet" href="views/css/recipe.css">
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
<main class="recipe-container">
    <h1>
        <?= $recipe->getName() ?>
    </h1>
    <div class="info-btn-container">
        <svg class="like-recipe" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M30 15.0005C25.5015 9.75792 17.9844 8.13775 12.3481 12.9384C6.7117 17.739 5.91817 25.7652 10.3444 31.443C14.0246 36.1635 25.162 46.1198 28.8122 49.3423C29.2205 49.7028 29.4247 49.883 29.663 49.9538C29.8707 50.0155 30.0982 50.0155 30.3062 49.9538C30.5445 49.883 30.7485 49.7028 31.157 49.3423C34.8072 46.1198 45.9445 36.1635 49.6247 31.443C54.051 25.7652 53.3543 17.6885 47.621 12.9384C41.8878 8.18825 34.4985 9.75792 30 15.0005Z" stroke="#2D3142" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <img class="timer-recipe" src="images/timer.svg" alt="">
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
    <?php if ($isRecipeLiked) { ?>
        <div class="favourite-recipe liked">like</div>
    <?php } else { ?>
        <div class="favourite-recipe not-liked">like</div>
    <?php } ?>
    <div class="rating">
        <div class="count-rating">
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
    <div class="avg-rating">
        <?= $recipeRating["average_rating"] ?>
    </div>

    <div class="recipe-ingredients">
        <div class="in-kitchen-container">
            <h3>Appliances</h3>
            <div class="recipe-appliances">
                <?php
                /** @var EquipmentEntity $equipment */
                ?>
                <?php foreach ($recipeEquipmentsNames as $equipmentName) { ?>
                    <p class="equipments">
                        <span class="equipment">
                            <?= $equipmentName ?>
                        </span>
                    </p>
                <?php } ?>
            </div>
        </div>
        <div class="to-buy-container">
            <h3>Ingredients</h3>
            <div class="to-buy">
                <?php foreach ($ingredientsUserHave as $ingredient) { ?>

                    <p class="green">
                        <span class="ingredient-have-name">
                            <?= $ingredient->getName() ?>
                        </span>
                        <span class="units">
                            <?= $ingredient->getQuantityMetric() ?>
                            <?= $ingredient->getUnitMetric() ?>
                        </span>
                    </p>
                <?php } ?>
                <?php foreach ($ingredientsUserHaveNot as $ingredient) { ?>
                    <p class="">
                        <span class="ingredient-dont-have-name">
                            <?= $ingredient->getName() ?>
                        </span>
                        <span class="units">
                            <?= $ingredient->getQuantityMetric() ?>
                            <?= $ingredient->getUnitMetric() ?>
                        </span>
                    </p>

                <?php } ?>
            </div>
        </div>
    </div>
    <div class="directions">
        <h3>Directions</h3>
        <ol>
            <?php foreach ($recipe->getSteps() as $step) { ?>
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


<script src='views/javascript/recipe.js'>
</script>

<?php $script = ob_get_clean() ?>

<?php require_once('template.php')
?>