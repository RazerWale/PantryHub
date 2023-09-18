<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <title>
        <?= $title ?>
        <!-- PHP -->
    </title>
    <link href="style.css" rel="stylesheet" />
    <?= $style ?>
    <!-- PHP -->
</head>

<body>
    <header>
        <a href="?action=main"><img src="images/pantryhublogo.svg" alt="PantryHub logo"></a>
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
    <?= $content ?>
    <!-- PHP -->
    <?= $script ?>
    <script>
        let hamburgerExitBtn = document.querySelector('.hamburger');
        //let hamburgerBar = document.querySelector('.bar');
        let hamburgerBtn = document.querySelector('.hamburger-icon');
        let navMenu = document.querySelector('ul');

        hamburgerExitBtn.addEventListener('click', function() {
            hamburgerExitBtn.style.display = "none";
            //hamburgerBar.style.display = "none";
            hamburgerBtn.style.display = "inline";
            navMenu.style.inset = "0 0 0 100%";
        });

        hamburgerBtn.addEventListener('click', function() {
            hamburgerExitBtn.style.display = "block";
            //hamburgerBar.style.display = "block";
            hamburgerBtn.style.display = "none";
            navMenu.style.inset = "0 0 0 50%";
        });
    </script>
    <!-- PHP -->
    <?= $script ?>
</body>



</html>