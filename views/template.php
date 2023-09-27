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
    <!-- <link href="views/css/profileTemplate.css" rel="stylesheet" /> -->
    <?= $style ?>
    <!-- PHP -->
</head>

<body>
    <?php if (!isset($_SESSION['loggedIn'])) { ?>
        <header>
            <a href="?action=main"><img src="images/pantryhublogo.svg" alt="PantryHub logo"></a>
            <nav>
                <ul class="nav-links">
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
    <?php } else { ?>
        <div class="profile-template-body">
            <div class="profile-container">
                <img class="logo" src="images/pantryhublogo.svg" alt="">
                <div class="profilemenu">
                    <ul class="nav-links">
                        <li><a href="http://localhost/PantryHub/?action=profilePage">Home</a></li>
                        <li><a href="#">Personal Info</a></li>
                        <li><a href="#">Payment</a></li>
                        <li><a href="#">Support/FAQ</a></li>
                        <li><a href="?action=kitchenPage">My Kitchen</a></li>
                        <form action="?action=login" method="GET">
                            <div class="logOut">
                                <input type="hidden" name="action" value="login"></input>
                                <button type="submit" name="logOut" value="logOut">Log Out</button>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
            <div class="search-container">
                <form class="search-form" action="?action=search" method="GET">
                    <input type="hidden" name="action" value="search">
                    <input type="text" placeholder="Search Here" name="search-item">
                    <button type="submit">Search</button>
                </form>
                <?= $content ?>
            </div>
        </div>
    <?php } ?>
    <!-- PHP -->
    <script>
        <?php if (!isset($_SESSION['loggedIn'])) { ?>

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
        <?php } ?>

    </script>
    <!-- PHP -->
    <?= $script ?>
</body>



</html>