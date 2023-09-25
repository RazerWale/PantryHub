<?php
require_once('models/UserManager.php');

/**
 * Summary of MainPageController
 */
class MainPageController
{
    /**
     * Summary of recipeManager
     * @var RecipeManager
     */
    protected $recipeManager; // Attribute 
    /**
     * Summary of userManager
     * @var UserManager
     */
    protected $userManager; // Attribute 

    public function __construct() // Constructor 
    {
        $this->recipeManager = new RecipeManager();
        $this->userManager = new UserManager();
    }
    public function default()
    {
        require_once('views/main.php');
    }
    public function profilePage()
    {
        $recipesByIngredient = [];
        $recipesByEquipment = [];

        $recipes = [];
        $userId = $_SESSION['userId'];
        $userIngredients = $this->userManager->fetchUserIngredients($userId);
        $userEquipments = $this->userManager->fetchUserEquipments($userId);
        $ingredientsIds = [];
        $equipmentsIds = [];
        foreach ($userIngredients as $ingredient) {
            $ingredientsIds[] = $ingredient->getId();
        }
        foreach ($userEquipments as $equipment) {
            $equipmentsIds[] = $equipment->getId();
        }
        if (!empty($ingredientsIds)) {
            $recipesByIngredient = $this->recipeManager->fetchRecipesByIngredients($ingredientsIds);
        }
        if (!empty($equipmentsIds)) {
            $recipesByEquipment = $this->recipeManager->fetchRecipesByEquipments($equipmentsIds);
        }
        $recipesIds = [];
        foreach ($recipesByIngredient as $id) {
            $recipesIds[] = [
                'id' => $id['id'],
                'count' => $id['ingredients_count']
            ];
        }


        foreach ($recipesByEquipment as $equipment) {
            $result = false;
            foreach ($recipesIds as $key => $recipe) {
                if ($recipe['id'] === $equipment['id']) {
                    $result = true;
                    $recipesIds[$key]['count'] += $equipment['equipments_count'];
                }
            }
            if (!$result) {
                $recipesIds[] = [
                    'id' => $equipment['id'],
                    'count' => $equipment['equipments_count']
                ];
            }
        }
        $column = array_column($recipesIds, 'count');
        array_multisort($column, SORT_DESC, $recipesIds);


        $ids = array_map(function ($value) {
            return $value['id'];
        }, $recipesIds);

        $recipes = $this->recipeManager->fetchRecipesByIds($ids);
        require_once('views/profile.php');
    }

    public function recipePage()
    {
        if (!isset($_GET['id'])) {
            throw new Exception('no id is provided!');
        }
        $id = $_GET['id'];
        $userId = $_SESSION['userId'];
        $recipe = $this->recipeManager->fetchRecipe($id);
        $recipeIngredients = $recipe->getIngredients();

        $userIngredients = $this->userManager->fetchUserIngredients($userId);
        $userIngredientsIds = array_map(function ($ingredient) {
            return $ingredient->getId();
        }, $userIngredients);

        $ingredientsUserHave = [];
        $ingredientsUserHaveNot = [];

        foreach ($recipeIngredients as $ingredients) {
            $ingredientId = $ingredients->getId();
            if (in_array($ingredientId, $userIngredientsIds)) {
                $ingredientsUserHave[] = $ingredients;
            } else {
                $ingredientsUserHaveNot[] = $ingredients;
            }
        }


        require_once('views/recipe.php');
    }
    public function kitchenPage()
    {
        require_once('views/kitchen.php');
    }
}