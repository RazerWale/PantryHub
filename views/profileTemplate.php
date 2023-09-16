<?php $title = "Profile"; ?>



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
        width: 80vw;
    }

    .recipe-links {
        display: inline-block;
        width: 30px;
    }

    .recipe-links img {
        height: 20px;
    }
</style>

<?php $style2 = ob_get_clean() ?>



<?php ob_start() ?>
<!-- html for this page is here!(you can use PHP variables here from the controller) -->
<img class="logo" src="images/pantryhublogo.svg" alt="">
<div class="profilemenu">
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Personal Info</a></li>
        <li><a href="#">Payment</a></li>
        <li><a href="#">Support/FAQ</a></li>
        <li><a href="#">My Kitchen</a></li>
        <li><a href="#">Log Out</a></li>
    </ul>
</div>
<div class="search-container">
    <form action="">
        <input type="text" placeholder="Search Here" name="search-item">
        <button type="submit">Search</button>
    </form>
</div>
<!--<main>
    <div class="liked-recommend-buttons"><button>Recommended Recipes</button><button>Liked Recipes</button></div>
    <div class="liked-recommend">
        <div class="recommended-recipes">
            <div class="rec-recipe">
                <img src="https://spoonacular.com/recipeImages/157344-636x393.jpg" alt="">
                <div class="recipe-links">
                    <img src="images/heart.svg" alt="">
                    <img src="images/share.svg" alt="">
                    <img src="images/timer.svg" alt="">
                </div>
                <a href="#">Spicy Salad with Kidney Beans, Cheddar, and Nuts</a>
                <div class="recipe-ingredients">
                    <div class="ingredients-needed">kidney beans, nuts</div>
                    <div class="ingredients-owned">cheddar</div>
                </div>
            </div>
        </div>
        <div class="liked-recipes">
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
        </div>
    </div>
</main>-->

<?php $content2 = ob_get_clean() ?>



<?php ob_start() ?>

<script src='path to the file'>
    /* JScript for this page is here! */
</script>

<?php $script2 = ob_get_clean() ?>