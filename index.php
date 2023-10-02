<?php

session_start();

try {
    require_once('controllers/RecipeController.php');
    require_once('controllers/IngredientController.php');
    require_once('controllers/EquipmentController.php');
    require_once('controllers/UserController.php');
    require_once('controllers/MainPageController.php');

    $recipe = new RecipeController();
    $ingredient = new IngredientController();
    $equipment = new EquipmentController();
    $user = new UserController();
    $main = new MainPageController();

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
            $main->recipePage();
            break;
        case 'kitchenPage';
            $main->kitchenPage();
        case 'search';
            $recipe->search();
            break;
        case 'searchByLetters';
            $main->searchByLetters();
            break;
        case 'removeFavouriteRecipe';
            $user->removeFavouriteRecipe();
            break;
        case 'addUserFavouriteRecipe';
            $user->addUserFavouriteRecipe();
            break;
        default:
            //should bring me to the home page
            $main->default();
            break;
    }
} catch (Throwable $e) {
    // displayError($e->getMessage());
    echo $e->getMessage();
    throw $e;
    // die;
    // displayTheError($e);
}