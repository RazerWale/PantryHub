<?php $title = "PantryHub"; ?>

<?php ob_start() ?>

<link rel="stylesheet" href="views/css/main.css">
<style>

</style>

<?php $style = ob_get_clean() ?>



<?php ob_start() ?>
<div class="main-info">
    <h1>Mindful Cooking</h1>
    <p>Save money, and time, on finding delicious recipes based on what’s already in your kitchen. Need to know what
        your missing in a recipe you want to try? Get a list of items you already have and what you need.</p>
    <button><a href="?action=registerUser">Get Started Here</a></button>
    <img src="images/fridgeimg.png" alt="red fridge">

</div>

<?php $content = ob_get_clean() ?>



<?php ob_start() ?>

<script>

</script>

<?php $script = ob_get_clean() ?>


<?php require_once('template.php') ?>