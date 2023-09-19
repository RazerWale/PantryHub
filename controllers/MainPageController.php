<?php

class MainPageController
{
    protected $recipeManager; // Attribute 

    public function __construct() // Constructor 
    {
        $this->recipeManager = new RecipeManager();
    }
    public function default()
    {
        require_once('views/main.php');
    }
    public function profilePage()
    {
        $recipes = [];

        require_once('views/profile.php');
    }
    public function recipePage()
    {
        if (!isset($_GET['id'])) {
            throw new Exception('no id is provided!');
        }
        $id = $_GET['id'];
        $recipe = $this->recipeManager->fetchRecipe($id);

        require_once('views/recipe.php');
    }
    public function kitchenPage()
    {
        require_once('views/kitchen.php');
    }
}
