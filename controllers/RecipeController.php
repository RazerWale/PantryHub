<?php

require_once('models/RecipeManager.php');

class RecipeController
{
    protected $recipeManager; // Attribute 

    public function __construct() // Constructor 
    {
        $this->recipeManager = new RecipeManager();
    }

    public function listRecipes()
    {
        $recipes = $this->recipeManager->getRecipes();
        require_once('views/main.php');
    }


}