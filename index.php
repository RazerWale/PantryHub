<?php


try {
    require_once('controllers/RecipeController.php');
    // require_once('controllers/UserController.php');

    // controller here!
    $test = new RecipeController();

    $route = $_GET['action'] ?? null;

    switch ($route) {
        case 'test':
            $test->listRecipes();
            break;
        case 'test2':
            $test->listRecipe();
            break;
        case 'insert':
            $test->insertRecipe();
            break;
        case 'delete':
            $test->deleteRecipe();
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