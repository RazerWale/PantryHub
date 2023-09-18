<!-- html for this page is here!(you can use PHP variables here from the controller) -->
<img class="logo" src="images/pantryhublogo.svg" alt="">
<div class="profilemenu">
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Personal Info</a></li>
        <li><a href="#">Payment</a></li>
        <li><a href="#">Support/FAQ</a></li>
        <li><a href="#">My Kitchen</a></li>
        <!-- <li><a href="#">Log Out</a></li> -->
        <form action="?action=login" method="GET">
            <div class="logOut">
                <input type="hidden" name="action" value="login"></input>
                <button type="submit" name="logOut" value="logOut">Log Out</button>
            </div>
        </form>
    </ul>
</div>
<div class="search-container">
    <form action="?action=search" method="GET">
        <input type="hidden" name="action" value="search">
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