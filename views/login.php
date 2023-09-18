<?php $title = "Login"; ?>



<?php ob_start() ?>

<link rel="stylesheet" href="views/css/login.css">
<style>
    /* CSS for this page is here! */
</style>

<?php $style = ob_get_clean() ?>



<?php ob_start() ?>
<div class="login-div">
    <h1>Welcome Back<br>
        Login Here.
    </h1>
    <form form action="?action=login" method="POST">
        <div class="input-box">
            <input type="text" placeholder="Enter Username/Email" name="useremail" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Enter Password" name="password" required>
        </div>
        <div class="remember-forget">
            <label for=""></label>
        </div>
        <button class="login-submit" type="submit">Login</button>
        <div class="sign-in-opts">
            <p>-Or Sign In With-</p>
            <div class="logos">
                <img src="images/googlelogo.svg" alt="">
                <img src="images/applelogo.svg" alt="">
                <img src="images/fblogo.svg" alt="">
            </div>
            <p>No account? Sign Up <a href="?action=registerUser">Here</a>.</p>

        </div>
    </form>
</div>

<?php $content = ob_get_clean() ?>



<?php ob_start() ?>

<script>

</script>

<?php $script = ob_get_clean() ?>


<?php require_once('template.php') ?>