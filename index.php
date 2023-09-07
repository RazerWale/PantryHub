<?php


try {
    require_once('controllers/RecipeController.php');
    require_once('controllers/IngredientController.php');
    require_once('controllers/EquipmentController.php');
    // require_once('controllers/UserController.php');

    // controller here!
    $recipe = new RecipeController();
    $ingredient = new IngredientController();
    $equipment = new EquipmentController();

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
        default:
            //should bring me to the home page
            $test->default();
            break;
    }
} catch (Throwable $e) {
    // displayError($e->getMessage());
    // echo $e->getMessage();
    throw $e;
    // die;
    // displayTheError($e);
}