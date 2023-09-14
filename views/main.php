<?php $title = "PantryHub"; ?>



<?php ob_start() ?>

<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="views/css/main.css">
<style>
    /* CSS for this page is here! */
</style>

<?php $style = ob_get_clean() ?>



<?php ob_start() ?>
<header>
    <img src="images/pantryhublogo.svg" alt="PantryHub logo">
    <nav>
        <ul>
            <li>About</li>
            <li>Pricing</li>
            <li>Help</li>
            <li>Login</li>
        </ul>
    </nav>
    <img class="hamburger-icon" src="images/hamburgermenu.svg" alt="Hamburger Menu">
</header>
<div class="main-info">
    <h1>Mindful Cooking</h1>
    <p>Save money, and time, on finding delicious recipes based on what’s already in your kitchen. Need to know what your missing in a recipe you want to try? Get a list of items you already have and what you need.</p>
    <button><a href="?action=registerUser">Get Started Here</a></button>
    <img src="images/fridgeimg.png" alt="red fridge">

</div>
<!--<div class="recipe">
     html for this page is here!(you can use PHP variables here from the controller)
    hello there
</div>-->

<?php $content = ob_get_clean() ?>



<?php ob_start() ?>

<script src='path to the file'>
    /* JScript for this page is here! */
</script>

<?php $script = ob_get_clean() ?>


<?php require_once('template.php') ?>