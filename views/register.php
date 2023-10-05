<?php $title = "Registration"; ?>



<?php ob_start() ?>
<link rel="stylesheet" href="views/css/register.css">
<style>
</style>

<?php $style = ob_get_clean() ?>


<?php ob_start() ?>

<div class="container">
    <h1>Registration Form</h1>
    <div class="progress-bar">
        <div class="progress-step" data-title="Personal"></div>
        <div class="progress-step" data-title="Diets & Restrictions"></div>
        <div class="progress-step" data-title="Appliances"></div>
        <!-- <div class="step">
            <p>Personal Info</p>
            <span class="bullet">1</span>
        </div>
        <div class="step">
            <p>Diet Info</p>
            <span class="bullet">2</span>
        </div>
        <div class="step">
            <p>Appliances</p>
            <span class="bullet">3</span>
        </div>
        <div class="step">
            <p>Confirm</p>
            <span class="bullet">4</span>
        </div> -->
    </div>
    <div class="form-outer">
        <form action="?action=registerUser" method="POST" id="form">
            <div class="page page1 slidepage">
                <h2>Personal Info</h2>
                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" name="username" required id="username">
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" name="email" required id="email">
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" name="password" required id="password">
                </div>
                <div class="field">
                    <label for="passCon">Confirm Password</label>
                    <input type="password" name="passCon" required id="passCon">
                </div>
                <div class="field">
                    <button class="nextBtn">Next</button>
                </div>
            </div>

            <div class="page page2 slidenextpg2">
                <h2>Diets & Restrictions</h2>
                <div class="field">
                    <img src="images/dairyfree.svg" alt="">
                    <input type="checkbox" id="dairy free" name="dairy free">
                    <label for="dairy-free">Dairy-Free</label>
                </div>
                <!--<div class="field">
                    <img src="images/nutfree.svg" alt="">
                    <input type="checkbox" id="nut free" name="nut free">
                    <label for="nut-free">Nut-Free</label>
                </div>-->
                <div class="field">
                    <img src="images/glutenfree.svg" alt="">
                    <input type="checkbox" id="gluten free" name="gluten free">
                    <label for="gluten-free">Gluten-Free</label>
                </div>
                <!--<div class="field">
                    <img src="images/fishfree.svg" alt="">
                    <input type="checkbox" id="seafood free" name="seafood free">
                    <label for="seafood-free">Seafood-Free</label>
                </div>-->
                <div class="field">
                    <img src="images/keto.svg" alt="">
                    <input type="checkbox" id="ketogenic" name="ketogenic">
                    <label for="ketogenic">Keto Diet</label>
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
                    <input type="checkbox" id="pescatarian" name="pescatarian">
                    <label for="pescatarian">Pescatarian Diet</label>
                </div>
                <div class="field btns">
                    <button class="prev-1 prev">Previous</button>
                    <button class="next-1 next">Next</button>
                </div>
            </div>

            <div class="page page3 slideprevpg3">
                <h2>Appliances</h2>
                <div class="field">
                    <img src="images/oven.svg" alt="">
                    <input type="checkbox" id="oven" name="oven">
                    <label for="oven">Oven</label>
                </div>
                <!--<div class="field">
                    <img src="images/fryer.svg" alt="">
                    <input type="checkbox" id="airfryer" name="airfryer">
                    <label for="airfryer">Air Fryer</label>
                </div>-->
                <!--<div class="field">
                    <img src="images/mixer.svg" alt="">
                    <input type="checkbox" id="mixer" name="mixer">
                    <label for="mixer">Mixer</label>
                </div>-->
                <div class="field">
                    <img src="images/blender.svg" alt="">
                    <input type="checkbox" id="blender" name="blender">
                    <label for="blender">Blender</label>
                </div>
                <!--<div class="field">
                    <img src="images/juicer.svg" alt="">
                    <input type="checkbox" id="juicer" name="juicer">
                    <label for="juicer">Juicer</label>
                </div>-->
                <div class="field">
                    <img src="images/pressurecooker.svg" alt="">
                    <input type="checkbox" id="cooker" name="cooker">
                    <label for="cooker">Pressure Cooker</label>
                </div>
                <!--<div class="field">
                    <img src="images/toaster.svg" alt="">
                    <input type="checkbox" id="toaster" name="toaster">
                    <label for="toaster">Toaster</label>
                </div>-->
                <div class="field">
                    <img src="images/microwave.svg" alt="">
                    <input type="checkbox" id="microwave" name="microwave">
                    <label for="microwave">Microwave</label>
                </div>
                <div class="field btns">
                    <button class="prev-2 prev">Previous</button>
                    <input type="submit" class="reg-submit" id="submit" value="Submit">
                </div>
            </div>
        </form>
    </div>
</div>

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>


<script>
    /* JScript for this page is here!*/
    let slidePage = document.querySelector(".slidepage");
    let firstNextBtn = document.querySelector(".nextBtn");

    let secondNextBtn = document.querySelector(".next-1");
    let secondPrevBtn = document.querySelector(".prev-1");

    let thirdPrevBtn = document.querySelector(".prev-2");
    let formSubmitBtn = document.querySelector(".reg-submit");

    let slidePage2 = document.querySelector(".slidenextpg2");
    let slidePrevPage3 = document.querySelector(".slideprevpg3");

    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passConInput = document.getElementById('passCon');
    const submitBtn = document.getElementById('submit');
    const submitForm = document.getElementById('form');
    console.log(usernameInput.value);

    firstNextBtn.addEventListener("click", function(event) {
        event.preventDefault();
        if (usernameInput.value !== '' && emailInput.value !== '' && passwordInput.value !== '' && passConInput.value !== '') {
            slidePage.style.marginLeft = "-31.24%";
        } else {
            alert('please input all the fields')
            // slidePrevPage3.style.marginLeft = "31.2%";
            // slidePage2.style.marginLeft = "31.2";
        }
    });
    secondNextBtn.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage.style.marginLeft = "-62.48%";
    });
    secondPrevBtn.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage.style.marginLeft = "0";
    });
    thirdPrevBtn.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage.style.marginLeft = "-31.24%";
    });

    submitBtn.addEventListener("click", function(event) {

    })
    // secondPrevBtn.addEventListener("click", function(event) {
    //     event.preventDefault();
    //     slidePage.style.marginLeft = "-93.72%";
    //     slidePrevPage3.style.marginLeft = "31.2%";
    //     slidePage2.style.marginLeft = "31.2";
    // });
</script>

<?php $script = ob_get_clean() ?>


<?php require_once('template.php') ?>