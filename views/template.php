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

<body <?php if (isset($_SESSION['loggedIn'])) { ?> style="background-color: var(--secondary-bg-color);" <?php } ?>>
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
            <div class="hamburger-exit">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <img class="hamburger-icon" src="images/hamburgermenu.svg" alt="Hamburger Menu">
        </header>
        <?= $content ?>
    <?php } else { ?>
        <div class="profile-template-body">
            <div class="profile-container">
                <div class="profilemenu">
                    <img class="logo" src="images/pantryhublogo.svg" alt="">
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
                    <input type="text" placeholder="Search Here" id="search" name="search-item" autocomplete="off">
                    <button type="submit">Search</button>
                    <ul class="search-output"></ul>
                </form>
                <?= $content ?>
            </div>
        </div>
    <?php } ?>
    <!-- PHP -->
    <script>
        <?php if (!isset($_SESSION['loggedIn'])) { ?>

            let hamburgerExitBtn = document.querySelector('.hamburger-exit');
            let hamburgerBtn = document.querySelector('.hamburger-icon');
            let navMenu = document.querySelector('.nav-links');

            hamburgerBtn.addEventListener('click', function() {
                //hamburgerBtn.classList.toggle("inactive");
                navMenu.classList.toggle("active");
                hamburgerExitBtn.classList.toggle("active");

            });

            hamburgerExitBtn.addEventListener('click', function() {
                hamburgerExitBtn.classList.remove("active");
                //hamburgerBtn.style.classList.remove("inactive");
                //hamburgerBtn.style.classList.toggle("active");
                navMenu.classList.remove("active");
            });
        <?php } ?>
    </script>
    <!-- PHP -->
    <?= $script ?>
</body>



</html>