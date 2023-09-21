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
        $recipes = $this->recipeManager->fetchRecipes();
        require_once('views/main.php');
    }
    public function addRecipe()
    {
        $recipe = new RecipeEntity('name106', 406, null);
        $ingredients = new RecipeIngredientsEntity('Carrot');
        $ingredients->setRecipeIngredientId(47)
            ->setQuantityUs(77)
            ->setQuantityMetric(999)
            ->setUnitUs('miles')
            ->setUnitMetric('kilogram');
        $recipe->setSteps([new StepEntity('just cook it')]);
        $recipe->setEquipments([new EquipmentEntity('spoon', 778)]);
        $recipe->setIngredients([$ingredients]);
        $this->recipeManager->insertRecipes($recipe);
    }

    public function removeRecipe()
    {
        $id = 406;
        $this->recipeManager->deleteRecipe($id);
    }


    public function default()
    {
        require_once('views/main.php');
    }
    public function search()
    {
        $recipes = [];

        if (!empty($_GET['search-item'])) {
            $searchItem = $_GET['search-item'];
            var_dump($searchItem);


            $recipeIds = $this->recipeManager->search($searchItem);
            foreach ($recipeIds as $recipe) {
                $recipeEntity = $this->recipeManager->fetchRecipe($recipe);
                $recipes[] = $recipeEntity;
            }
            // var_dump($arrayRecipes);
            // return $recipes;
        }
        require_once('views/profile.php');


    }

}