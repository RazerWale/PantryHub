<?php

require_once('Manager.php');
require_once('IngredientManager.php');
require_once('EquipmentManager.php');
require_once('entities/RecipeEntity.php');
require_once('entities/EquipmentEntity.php');
require_once('entities/StepEntity.php');
require_once('entities/RecipeIngredientsEntity.php');
/**
 * Summary of RecipeManager
 */
class RecipeManager extends Manager
// get all
// get one
// insert
// delete
// update(optional)
{
    protected $ingredientManager;
    protected $equipmentManager;

    public function __construct()
    {
        parent::__construct();
        $this->ingredientManager = new IngredientManager();
        $this->equipmentManager = new EquipmentManager();
    }


    /**
     * Summary of getRecipes
     * @return RecipeEntity[]
     */
    public function getRecipes(): array
    {
        $req = $this->db->query('
        SELECT * 
        FROM recipes 
        ORDER BY name DESC  
    '); // this query gives you all the recipes from DB ordered by name
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $arrayOfCuisines = explode(',', $row['cuisine_type']);
            $arrayOfMeals = explode(',', $row['meal_type']);
            $arrayOfDiets = explode(',', $row['diets']);
            $recipe = new RecipeEntity($row['name'], $row['id'], $row['image_url'], $arrayOfCuisines, $arrayOfMeals, $arrayOfDiets, $row['time_to_cook'], $row['servings'], $row['calories'], new DateTime($row['created_at']));
            // set steps
            $steps = $this->getSteps($row['id']);
            $recipe->setSteps($steps);

            // set ingredients
            $ingredients = $this->ingredientManager->getIngredientsForRecipe($row['id']);
            $recipe->setIngredients($ingredients);

            // set equipments
            $equipments = $this->equipmentManager->getEquipmentsForRecipe($row['id']);
            var_dump($recipe->setEquipments($equipments));

            $result[] = $recipe;
        }
        // var_dump($result);
        return $result;
    }

    /**
     * Summary of getRecipe
     * @param int $id
     * @return RecipeEntity
     */
    public function getRecipe(int $id): RecipeEntity // this query gives you one recipe by id
    {
        $req = $this->db->prepare('
        SELECT * 
        FROM recipes 
        WHERE recipes.id = ?
    ');
        $req->execute([$id]);
        $result = $req->fetch(PDO::FETCH_ASSOC); // gives back only one row each call (if you will use loop, use while!)
        $arrayOfCuisines = explode(',', $result['cuisine_type']);
        $arrayOfMeals = explode(',', $result['meal_type']);
        $arrayOfDiets = explode(',', $result['diets']);
        $recipe = new RecipeEntity($result['name'], $result['id'], $result['image_url'], $arrayOfCuisines, $arrayOfMeals, $arrayOfDiets, $result['time_to_cook'], $result['servings'], $result['calories'], new DateTime($result['created_at']));


        // set steps
        $steps = $this->getSteps($id);
        $recipe->setSteps($steps);

        // set ingredients
        $ingredients = $this->ingredientManager->getIngredientsForRecipe($id);
        $recipe->setIngredients($ingredients);

        // set equipments
        $equipments = $this->equipmentManager->getEquipmentsForRecipe($id);
        var_dump($recipe->setEquipments($equipments));

        var_dump($recipe);
        return $recipe;
    }

    /**
     * Summary of insertRecipes
     * @param RecipeEntity $recipe
     */
    public function insertRecipes(RecipeEntity $recipe)
    {
        $req = $this->db->prepare('
        INSERT INTO recipes(id,
        name,
        image_url,
        cuisine_type,
        meal_type,
        diets,
        time_to_cook,
        servings,
        calories)
      
        VALUES (?,?,?,?,?,?,?,?,?)
        ');

        $arrayOfCuisines = null;
        $arrayOfMeals = null;
        $arrayOfDiets = null;

        if ($recipe->getCuisineTypes() !== null) {
            $arrayOfCuisines = implode(',', $recipe->getCuisineTypes());
        }
        if ($recipe->getMealTypes() !== null) {
            $arrayOfMeals = implode(',', $recipe->getMealTypes());
        }
        if ($recipe->getDiets() !== null) {
            $arrayOfDiets = implode(',', $recipe->getDiets());
        }
        $req->execute([$recipe->getId(), $recipe->getName(), $recipe->getImageUrl(), $arrayOfCuisines, $arrayOfMeals, $arrayOfDiets, $recipe->getTimeToCook(), $recipe->getServings(), $recipe->getCalories()]);

        $req2 = $this->db->prepare('
        INSERT INTO steps(recipe_id,
        step_number,
        description)

        VALUES (?,?,?)
        ');
        foreach ($recipe->getSteps() as $step) {
            $req2->execute([$recipe->getId(), $step->getStepNumber(), $step->getDescription()]);
        }

        $req3 = $this->db->prepare('
        INSERT INTO recipe_ingredients(recipe_id,
        ingredient_id,
        quantity_us,
        quantity_metric,
        unit_us,
        unit_metric)

        VALUES (?,?,?,?,?,?)
        ');
        foreach ($recipe->getIngredients() as $ingredient) {
            $req3->execute([$recipe->getId(), $ingredient->getRecipeIngredientId(), $ingredient->getQuantityUs(), $ingredient->getQuantityMetric(), $ingredient->getUnitUs(), $ingredient->getUnitMetric()]);
        }

        $req4 = $this->db->prepare('
        INSERT INTO recipes_equipments(recipe_id,
        equipment_id)

        VALUES (?,?)
        ');
        foreach ($recipe->getEquipments() as $equipment) {
            $req4->execute([$recipe->getId(), $equipment->getId()]);
        }
    }

    public function deleteRecipe(int $id)
    {
        $req = $this->db->prepare('
        DELETE
        FROM recipes
        WHERE recipes.id = ?
        ');
        $req->execute([$id]);
    }

    /**
     * Summary of getSteps
     * @param int $id
     * @return StepEntity[] 
     */
    private function getSteps(int $id): array
    {
        // Steps query 

        $reqSteps = $this->db->prepare('
             SELECT *
             FROM steps
             WHERE steps.recipe_id = ?
             ');
        $reqSteps->execute([$id]);
        $resultSteps = $reqSteps->fetchAll(PDO::FETCH_ASSOC);


        // set Steps
        foreach ($resultSteps as $step) {
            $steps[] = new StepEntity($step['description'], $step['step_number'], $step['id']);
        }

        return $steps;
    }
}