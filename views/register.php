<?php $title = "Registration"; ?>



<?php ob_start() ?>
<link rel="stylesheet" href="views/css/register.css">
<style>
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
<div class="container">
    <div class="progress-bar">
        <div class="step">
            <p>Personal Information</p>
        </div>
        <div class="step">
            <p>Diet & Restrictions</p>
        </div>
        <div class="step">
            <p>Appliances</p>
        </div>
        <!--<div class="step">
            <p>Goods & Groceries</p>
        </div>-->
        <div class="step">
            <p>Confirm</p>
        </div>
    </div>
    <div class="form-outer">
        <form action="?action=register" method="POST">
            <div class="page page1 slidepage">
                <div class="field">
                    <div class="label">Username</div>
                    <input type="text" name="username">
                </div>
                <div class="field">
                    <div class="label">Email</div>
                    <input type="email" name="email">
                </div>
                <div class="field">
                    <div class="label">Password</div>
                    <input type="password" name="password">
                </div>
                <div class="field">
                    <div class="label">Confirm Password</div>
                    <input type="password" name="passCon">
                </div>
                <div class="field">
                    <button class="nextBtn">Next</button>
                </div>
            </div>

            <div class="page page2 slidenextpg2">
                <div class="field">
                    <img src="images/dairyfree.svg" alt="">
                    <input type="checkbox" id="dairy-free" name="dairy-free">
                    <label for="dairy-free">Dairy-Free</label>
                </div>
                <div class="field">
                    <img src="images/nutfree.svg" alt="">
                    <input type="checkbox" id="nut-free" name="nut-free">
                    <label for="nut-free">Nut-Free</label>
                </div>
                <div class="field">
                    <img src="images/glutenfree.svg" alt="">
                    <input type="checkbox" id="gluten-free" name="gluten-free">
                    <label for="gluten-free">Gluten-Free</label>
                </div>
                <div class="field">
                    <img src="images/fishfree.svg" alt="">
                    <input type="checkbox" id="seafood-free" name="seafood-free">
                    <label for="seafood-free">Seafood-Free</label>
                </div>
                <div class="field">
                    <img src="images/keto.svg" alt="">
                    <input type="checkbox" id="keto" name="keto">
                    <label for="keto">Keto Diet</label>
                </div>
                <div class="field">
                    <img src="images/paleo.svg" alt="">
                    <input type="checkbox" id="paleo" name="paleo">
                    <label for="paleo">Paleo Diet</label>
                </div>
                <div class="field">
                    <img src="images/vegetarian.svg" alt="">
                    <input type="checkbox" id="vegetarian" name="vegetarian">
                    <label for="vegetarian">Vegetarian Diet</label>
                </div>
                <div class="field">
                    <img src="images/vegan.svg" alt="">
                    <input type="checkbox" id="vegan" name="vegan">
                    <label for="vegan">Vegan Diet</label>
                </div>
                <div class="field">
                    <img src="images/mediterranean.svg" alt="">
                    <input type="checkbox" id="mediterranean" name="mediterranean">
                    <label for="mediterranean">Mediterranean Diet</label>
                </div>
                <div class="field btns">
                    <button class="prev-1 prev">Previous</button>
                    <button class="next-1 next">Next</button>
                </div>
            </div>

            <div class="page page3 slideprevpg3">
                <div class="field">
                    <img src="images/oven.svg" alt="">
                    <input type="checkbox" id="oven" name="oven">
                    <label for="toasteroven">Oven</label>
                </div>
                <div class="field">
                    <img src="images/fryer.svg" alt="">
                    <input type="checkbox" id="airfryer" name="airfryer">
                    <label for="airfryer">Air Fryer</label>
                </div>
                <div class="field">
                    <img src="images/mixer.svg" alt="">
                    <input type="checkbox" id="mixer" name="mixer">
                    <label for="mixer">Mixer</label>
                </div>
                <div class="field">
                    <img src="images/blender.svg" alt="">
                    <input type="checkbox" id="blender" name="blender">
                    <label for="blender">Blender</label>
                </div>
                <div class="field">
                    <img src="images/juicer.svg" alt="">
                    <input type="checkbox" id="juicer" name="juicer">
                    <label for="juicer">Juicer</label>
                </div>
                <div class="field">
                    <img src="images/pressurecooker.svg" alt="">
                    <input type="checkbox" id="cooker" name="cooker">
                    <label for="cooker">Pressure Cooker</label>
                </div>
                <div class="field">
                    <img src="images/toaster.svg" alt="">
                    <input type="checkbox" id="toaster" name="toaster">
                    <label for="toaster">Toaster</label>
                </div>
                <div class="field">
                    <img src="images/microwave.svg" alt="">
                    <input type="checkbox" id="microwave" name="microwave">
                    <label for="microwave">Microwave</label>
                </div>
                <div class="field btns">
                    <button class="prev-2 prev">Previous</button>
                    <input type="submit" class="reg-submit">Submit</input>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>

<script>
    /* JScript for this page is here! */
    let slidePage = document.querySelector(".slidepage");
    let firstNextBtn = document.querySelector(".nextBtn");

    let secondNextBtn = document.querySelector(".next-1");
    let slidePage2 = document.querySelector(".slidenextpg2");

    let secondPrevBtn = document.querySelector(".prev-2");
    let slidePrevPage3 = document.querySelector(".slideprevpg3");

    firstNextBtn.addEventListener("click", function(event) {
        //    event.preventDefault();
        //    slidePage.classList.add('active-pass');
        //});
        event.preventDefault();
        slidePage.style.marginLeft = "-31.2%";
    });
    firstNextBtn.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage.style.marginLeft = "-31.2%";
    });
    secondNextBtn.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage2.style.marginLeft = "-31.2%";
    });
    secondPrevBtn.addEventListener("click", function(event) {
        event.preventDefault();
        slidePrevPage3.style.marginLeft = "31.2%";
        slidePage2.style.marginLeft = "31.2";
    });
</script>

<?php $script = ob_get_clean() ?>


<?php require_once('template.php') ?>