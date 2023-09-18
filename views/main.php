<?php $title = "PantryHub"; ?>



<?php ob_start() ?>

<link rel="stylesheet" href="views/css/main.css">
<style>

</style>

<?php $style = ob_get_clean() ?>



<?php ob_start() ?>
<<<<<<< HEAD
=======
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
>>>>>>> 85723fa31c9b4877119a9df199603adfcfe53642
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

<<<<<<< HEAD
=======
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
>>>>>>> 85723fa31c9b4877119a9df199603adfcfe53642
</script>

<?php $script = ob_get_clean() ?>


<?php require_once('template.php') ?>