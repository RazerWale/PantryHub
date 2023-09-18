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
        case 'getRecipe':
            $recipe->getRecipe();
            break;
        case 'listRecipes':
            $recipe->listRecipes();
            break;
        case 'addRecipe':
            $recipe->addRecipe();
            break;
        case 'removeRecipe':
            $recipe->removeRecipe();
            break;
        case 'getIngredient':
            $ingredient->getIngredient();
            break;
        case 'listIngredients':
            $ingredient->listIngredients();
            break;
        case 'addIngredient':
            $ingredient->addIngredient();
            break;
        case 'removeIngredient':
            $ingredient->removeIngredient();
            break;
        case 'getEquipment':
            $equipment->getEquipment();
            break;
        case 'listEquipments':
            $equipment->listEquipments();
            break;
        case 'addEquipment':
            $equipment->addEquipment();
            break;
        case 'removeEquipment':
            $equipment->removeEquipment();
            break;
        case 'getUser';
            $user->getUser();
            break;
        case 'listUsers';
            $user->listUsers();
            break;
        case 'registerUser';
            if (!isset($_SESSION['loggedIn'])) {
                $user->registerUser();
            } else {
                header('Location: ?action=profilePage');
                exit;
            }
            break;
        case 'removeUser';
            $user->removeUser();
            break;
        case 'login';
            if (!isset($_SESSION['loggedIn']) || isset($_GET['logOut'])) {
                $user->login();
            } else {
                header('Location: ?action=profilePage');
                exit;
            }
            break;
        case 'addUserEquipment';
            $user->addUserEquipment();
            break;
        case 'getUserEquipments';
            $user->getUserEquipments();
            break;
        case 'removeUserEquipment';
            $user->removeUserEquipment();
            break;
        case 'addUserIngredient';
            $user->addUserIngredient();
            break;
        case 'getUserIngredients';
            $user->getUserIngredients();
            break;
        case 'removeUserIngredient';
            $user->removeUserIngredient();
            break;
        case 'addUserFavouriteRecipe';
            $user->addUserFavouriteRecipe();
            break;
        case 'getUserFavouriteRecipes';
            $user->getUserFavouriteRecipes();
            break;
        case 'removeFavouriteRecipe';
            $user->removeFavouriteRecipe();
            break;
        case 'profilePage';
            if ($_SESSION['loggedIn']) {
                $main->profilePage();
            } else {
                header('Location: ?action=login');
                exit;
            }
            break;
        case 'recipePage';
            $main->recipePage();
            break;
        case 'kitchenPage';
            $main->kitchenPage();
        case 'search';
            $recipe->search();
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