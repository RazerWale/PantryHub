<?php $title = "Registration"; ?>



<?php ob_start() ?>
<link rel="stylesheet" href="views/css/register.css">
<style>
</style>

<?php $style = ob_get_clean() ?>


<?php ob_start() ?>

<div class="container">
    <h1>Registration Form</h1>
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
                <div class="field">
                    <img src="images/glutenfree.svg" alt="">
                    <input type="checkbox" id="gluten free" name="gluten free">
                    <label for="gluten-free">Gluten-Free</label>
                </div>
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
                <div class="field">
                    <img src="images/blender.svg" alt="">
                    <input type="checkbox" id="blender" name="blender">
                    <label for="blender">Blender</label>
                </div>
                <div class="field">
                    <img src="images/pressurecooker.svg" alt="">
                    <input type="checkbox" id="cooker" name="cooker">
                    <label for="cooker">Pressure Cooker</label>
                </div>
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


<script src='views/javascript/register.js'>

</script>

<?php $script = ob_get_clean() ?>


<?php require_once('template.php') ?>