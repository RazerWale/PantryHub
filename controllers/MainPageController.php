<?php
require_once('models/UserManager.php');
require_once('models/IngredientManager.php');



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
    /**
     * Summary of userManager
     * @var IngredientManager
     */
    protected $ingredientManager;
    /**
     * Summary of userManager
     * @var EquipmentManager
     */
    protected $equipmentManager;


    //protected $ingredientManager;

    public function __construct() // Constructor 
    {
        $this->recipeManager = new RecipeManager();
        $this->userManager = new UserManager();
        $this->ingredientManager = new IngredientManager();
        $this->equipmentManager = new EquipmentManager();
    }
    public function default()
    {
        require_once('views/main.php');
    }
    public function profilePage()
    {
        $userId = $_SESSION['userId'];
        $isRecipeLiked = [];
        $recipeRating = [];
        $ids = $this->fetchRecipesIdsByIngredientsAndEquipments();
        $recipes = $this->recipeManager->fetchRecipesByIds($ids);
        foreach ($ids as $id) {
            $isRecipeLiked[] = $this->recipeManager->isRecipeLiked($userId, $id);
            $recipeRating[] = $this->recipeManager->fetchRecipeRating($id);
        }


        require_once('views/profile.php');
    }
    public function profilePageJson()
    {
        $ids = $this->fetchRecipesIdsByIngredientsAndEquipments();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $recipes = $this->recipeManager->fetchRecipesByIds($ids, $page);
        $result = array_map(function (RecipeEntity $recipe) {
            return [
                'id' => $recipe->getId(),
                'name' => $recipe->getName(),
                'ingredients' => array_map(function (RecipeIngredientsEntity $ingredient) {
                    return [
                        'name' => $ingredient->getName()
                    ];
                }, $recipe->getIngredients())
            ];
        }, $recipes);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }
    public function searchPageJson()
    {
        if (!empty($_GET['search-item'])) {
            $searchItem = $_GET['search-item'];

            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $ids = $this->recipeManager->search($searchItem, $page);
            $recipes = $this->recipeManager->fetchRecipesByIds($ids);
            $result = array_map(function (RecipeEntity $recipe) {
                return [
                    'id' => $recipe->getId(),
                    'name' => $recipe->getName(),
                    'ingredients' => array_map(function (RecipeIngredientsEntity $ingredient) {
                        return [
                            'name' => $ingredient->getName()
                        ];
                    }, $recipe->getIngredients())
                ];
            }, $recipes);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($result);
        }
    }
    public function fetchRecipesIdsByIngredientsAndEquipments(): array
    {
        $recipesByIngredient = [];
        $recipesByEquipment = [];
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
        return array_map(function ($value) {
            return $value['id'];
        }, $recipesIds);
    }

    public function recipePage()
    {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            throw new Exception('no id is provided!');
        }
        $id = $_GET['id'];
        $userId = $_SESSION['userId'];
        try {
            $recipe = $this->recipeManager->fetchRecipe($id);
            $recipeIngredients = $recipe->getIngredients();
            $recipeEquipments = $recipe->getEquipments();
            $isRecipeLiked = $this->recipeManager->isRecipeLiked($userId, $id);
            $recipeEquipmentsNames = [];
            foreach ($recipeEquipments as $equipment) {
                $recipeEquipmentsNames[] = $equipment->getName();
            }
            $recipeEquipmentsNames = array_unique($recipeEquipmentsNames);
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
            $recipeRating = $this->recipeManager->fetchRecipeRating($id);
        } catch (Throwable $t) {
            http_response_code(500);
            echo json_encode($t->getMessage());
        }
        require_once('views/recipe.php');
    }
    public function addUserFavouriteRecipes()
    {
        $userId = $_SESSION['userId'];
        try {
            $recipesIds = $this->userManager->fetchUserFavouriteRecipesIds($userId);
            $recipes = $this->recipeManager->fetchRecipesByIds($recipesIds);
            foreach ($recipesIds as $id) {
                $isRecipeLiked[] = $this->recipeManager->isRecipeLiked($userId, $id);
                $recipeRating[] = $this->recipeManager->fetchRecipeRating($id);
            }
        } catch (Throwable $t) {
            http_response_code(500);
            throw new Exception($t->getMessage());
        }
        require_once('views/profile.php');
    }
    public function kitchenPage()
    {
        require_once('views/kitchen.php');
    }

    public function addAppliances()
    {
        if (!empty($_GET['add-appliances-input'])) {
            $applianceSearchItem = $_GET['add-appliances-input'];
            $applianceName = $this->equipmentManager->appliancesByLetter($applianceSearchItem);
            $results = [];
            $results = [$applianceName];
            echo json_encode($results);
        }
    }

    public function addGroceries()
    {
        if (!empty($_GET['add-groceries-input'])) {
            $grocerySearchItem = $_GET['add-groceries-input'];
            $groceryName = $this->ingredientManager->groceriesByLetter($grocerySearchItem);
            $results = [];
            $results = [$groceryName];
            echo json_encode($results);
        }
    }

    public function searchByLetters()
    {
        if (!empty($_GET['search-input'])) {
            $searchValue = $_GET['search-input'];
            $recipesNames = $this->recipeManager->searchRecipesByLetter($searchValue);
            $ingredinetsName = $this->ingredientManager->searchIngredientByLetter($searchValue);
            $result = [];
            $result = [...$ingredinetsName, ...$recipesNames];
            echo json_encode($result);
        }
    }
}