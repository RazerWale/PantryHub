<?php
require_once('models/UserManager.php');

class MainPageController
{
    protected $recipeManager; // Attribute 
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

        $recipesByIngredient = $this->recipeManager->fetchRecipesByIngredients($ingredientsIds);
        $recipesByEquipment = $this->recipeManager->fetchRecipesByEquipments($equipmentsIds);
        $recipesIds = [];
        foreach ($recipesByIngredient as $id) {
            $recipesIds[] = [
                'id' => $id['id'],
                'count' => $id['ingredients_count']
            ];
        }
        $recipesIds[] = [
            'id' => 660306,
            'count' => 1
        ];

        foreach ($recipesByEquipment as $equipment) {
            // foreach ($recipesIds as $key => $id) {
            //     if ($equipment['id'] == $id['id']) {
            //         $recipesIds[$key]['count'] += $equipment['equipments_count'];
            //         continue;
            //     }
            // }
            // $recipesIds[] = [
            //     'id' => $equipment['id'],
            //     'count' => $equipment['equipments_count']
            // ];
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



        // var_dump($recipesByEquipment);
        var_dump($recipesIds);

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
// public function recommendedRecipes()
// {
//     $userId = $_SESSION['userId'];
//     $userIngredients = $this->userManager->fetchUserIngredients($userId);
//     $userEquipments = $this->userManager->fetchUserEquipments($userId);

//     $recipes = $this->recipeManager->fetchRecommendedRecipes($userIngredients, $userEquipments);
//     var_dump($recipes);

// }
}