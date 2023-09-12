<?php

require_once('models/IngredientManager.php');

/**
 * Summary of IngredientController
 */
class IngredientController
{
    protected $ingredientManager;

    public function __construct() // Constructor 
    {
        $this->ingredientManager = new IngredientManager();
    }

    public function getIngredient()
    {
        $id = 45;
        $ingredient = $this->ingredientManager->fetchIngredient($id);
        require_once('views/main.php');
    }
    public function listIngredients()
    {
        $ingredient = $this->ingredientManager->fetchIngredients();
        require_once('views/main.php');
    }
    public function addIngredient()
    {
        $ingredient = new IngredientEntity('carrot', null, null, 322, 'veggie');
        $this->ingredientManager->insertIngredient($ingredient);
    }
    public function removeIngredient()
    {
        $id = 44;
        $this->ingredientManager->deleteIngredient($id);
    }
}