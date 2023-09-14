<?php


try {
    require_once('controllers/RecipeController.php');
    require_once('controllers/IngredientController.php');
    require_once('controllers/EquipmentController.php');
    require_once('controllers/UserController.php');
    // require_once('controllers/UserController.php');

    // controller here!
    $recipe = new RecipeController();
    $ingredient = new IngredientController();
    $equipment = new EquipmentController();
    $user = new UserController();

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
            $user->registerUser();
            break;
        case 'removeUser';
            $user->removeUser();
            break;
        case 'login';
            $user->login();
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
        default:
            //should bring me to the home page
            $test->default();
            break;
    }
} catch (Throwable $e) {
    // displayError($e->getMessage());
    echo $e->getMessage();
    throw $e;
    // die;
    // displayTheError($e);
}
