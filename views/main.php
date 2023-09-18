<?php $title = "PantryHub"; ?>



<?php ob_start() ?>

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
            <li><a href="?action=login">Login</a></li>
        </ul>
    </nav>
    <button class="hamburger">
        <!--<div class="bar"></div>-->
    </button>
    <img class="hamburger-icon" src="images/hamburgermenu.svg" alt="Hamburger Menu">
</header>
<div class="main-info">
    <h1>Mindful Cooking</h1>
    <p>Save money, and time, on finding delicious recipes based on what’s already in your kitchen. Need to know what
        your missing in a recipe you want to try? Get a list of items you already have and what you need.</p>
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
    let hamburgerExitBtn = document.querySelector('.hamburger');
    //let hamburgerBar = document.querySelector('.bar');
    let hamburgerBtn = document.querySelector('.hamburger-icon');
    let navMenu = document.querySelector('ul');

    hamburgerExitBtn.addEventListener('click', function () {
        hamburgerExitBtn.style.display = "none";
        //hamburgerBar.style.display = "none";
        hamburgerBtn.style.display = "inline";
        navMenu.style.inset = "0 0 0 100%";
    });

    hamburgerBtn.addEventListener('click', function () {
        hamburgerExitBtn.style.display = "block";
        //hamburgerBar.style.display = "block";
        hamburgerBtn.style.display = "none";
        navMenu.style.inset = "0 0 0 50%";
    });
</script>

<?php $script = ob_get_clean() ?>


<?php require_once('template.php') ?>