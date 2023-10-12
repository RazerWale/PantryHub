<?php

session_start();

try {
    require_once('controllers/RecipeController.php');
    require_once('controllers/IngredientController.php');
    require_once('controllers/EquipmentController.php');
    require_once('controllers/UserController.php');
    require_once('controllers/MainPageController.php');
    require_once('controllers/KitchenController.php');

    $recipe = new RecipeController();
    $ingredient = new IngredientController();
    $equipment = new EquipmentController();
    $user = new UserController();
    $main = new MainPageController();
    $kitchen = new KitchenController();

    $route = $_GET['action'] ?? null;

    switch ($route) {
        case 'registerUser';
            if (!isset($_SESSION['loggedIn'])) {
                $user->registerUser();
            } else {
                header('Location: ?action=profilePage');
                exit;
            }
            break;
        case 'login';
            if (!isset($_SESSION['loggedIn']) || isset($_GET['logOut'])) {
                $user->login();
            } else {
                header('Location: ?action=profilePage');
                exit;
            }
            break;
        case 'profilePage';
            if ($_SESSION['loggedIn']) {
                $main->profilePage();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'profilePageJson';
            $main->profilePageJson();
            break;
        case 'searchPageJson';
            $main->searchPageJson();
            break;
        case 'recipePage';
            if ($_SESSION['loggedIn']) {
                $main->recipePage();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'kitchenPage';
            if ($_SESSION['loggedIn']) {
                $kitchen->kitchenPage();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'removeUserIngredient';
            if ($_SESSION['loggedIn']) {
                $kitchen->removeUserIngredient();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'removeUserEquipment';
            if ($_SESSION['loggedIn']) {
                $kitchen->removeUserEquipment();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'search';
            if ($_SESSION['loggedIn']) {
                $recipe->search();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'groceriesByLetter';
            if ($_SESSION['loggedIn']) {
                $main->addGroceries();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'appliancesByLetter';
            if ($_SESSION['loggedIn']) {
                $main->addAppliances();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'searchByLetters';
            if ($_SESSION['loggedIn']) {
                $main->searchByLetters();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'removeFavouriteRecipe';
            if ($_SESSION['loggedIn']) {
                $user->removeFavouriteRecipe();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'addUserFavouriteRecipe';
            if ($_SESSION['loggedIn']) {
                $user->addUserFavouriteRecipe();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'addOrUpdateRecipeRating';
            if ($_SESSION['loggedIn']) {
                $recipe->addOrUpdateRecipeRating();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'addUserFavouriteRecipes';
            if ($_SESSION['loggedIn']) {
                $main->addUserFavouriteRecipes();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'addGrocerysAndAppliances';
            if ($_SESSION['loggedIn']) {
                $user->addGrocerysAndAppliances();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        default:
            $main->default();
            break;
    }
} catch (Throwable $e) {
    echo $e->getMessage();
    throw $e;
}