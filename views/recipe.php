<?php $title = "Recipe"; ?>

<?php /*require_once('profileTemplate.php')*/ ?>


<?php ob_start() ?>

<!--<link rel="stylesheet" href="path to the file">-->
<style>
    /* CSS for this page is here! */
    body {
        display: grid;
        grid-template-columns: 300px 1fr;
        grid-template-rows: 80px 1fr 1fr 1fr;
    }

    .logo {
        grid-row-start: 1;
        grid-row-end: 2;
        grid-column-start: 1;

    }

    .profilemenu {
        grid-row-start: 2;
        grid-row-end: 5;
        grid-column-start: 1;
        grid-column-end: 2;
        height: 90vh;
        background-color: var(--tertiary-bg-color);
    }

    .profilemenu ul {
        display: flex;
        flex-direction: column;
    }

    .search-container {
        grid-row-start: 1;
        grid-row-end: 2;
        grid-column-start: 2;
        grid-column-end: 3;
    }

    .liked-recommend-buttons {
        grid-row-start: 2;
        grid-row-end: 3;
        grid-column-start: 2;
    }

    .liked-recommend {
        display: flex;
        flex-direction: row;
    }

    .recommended-recipes,
    .liked-recipe {
        width: 90vw;
    }

    .recipe-links {
        display: inline-block;
        width: 30px;
    }

    .recipe-links img {
        height: 20px;
    }

    .tags {
        height: 30px;
        width: 100px;
    }
</style>

<?php $style = ob_get_clean() ?>




<?php ob_start() ?>

<h1>
    <?= $recipe->getName() ?>
</h1>
<img src="https://spoonacular.com/recipeImages/<?= $recipe->getId() ?>-636x393.jpg" alt="">
<?php foreach ($recipe->getDiets() as $diet) { ?>
    <button class="tags">
        <?= $diet ?>
    </button>

<?php } ?>
<p>In Your Kitchen</p>
<div class="in-kitchen"></div>
<p>Items to Buy</p>
<div class="to-buy">
    <?php foreach ($recipe->getIngredients() as $ingredient) { ?>
        <div class="">
            <?= $ingredient->getName() ?>
        </div>
        <div class="">
            <?= $ingredient->getQuantityMetric() ?>
            <?= $ingredient->getUnitMetric() ?>
        </div>
    <?php } ?>
</div>
<div class="directions">
    <p>Directions</p>
    <?php foreach ($recipe->getSteps() as $step) { ?>
        <div class="">
            <?= $step->getStepNumber() ?>
        </div>
        <div class="">
            <?= $step->getDescription() ?>
        </div>
    <?php } ?>

</div>

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>


<script src='path to the file'>
    /* JScript for this page is here! */
</script>

<?php $script = ob_get_clean() ?>

<?php require_once('template.php')
?>