<?php

require_once('Manager.php');
/**
 * Summary of IngredientManager
 */
class IngredientManager extends Manager
{

    /**
     * Summary of getIngredientsForRecipe
     * @param int $id
     * @return RecipeIngredientsEntity[]
     */
    public function getIngredientsForRecipe(int $id): array
    {
        // Ingredients query

        $reqIngredients = $this->db->prepare('
         SELECT recipe_ingredients.*, ingredients.*
         FROM recipe_ingredients
         INNER JOIN ingredients ON ingredients.id = recipe_ingredients.ingredient_id
         WHERE recipe_ingredients.recipe_id = ?
         ');
        $reqIngredients->execute([$id]);
        $resultIngredients = $reqIngredients->fetchAll(PDO::FETCH_ASSOC);



        // set Ingredients
        foreach ($resultIngredients as $ingredient) {
            $recipeIngredients = new RecipeIngredientsEntity($ingredient['name'], $ingredient['ingredient_id'], $ingredient['image_url'], $ingredient['calories'], $ingredient['type']);
            $recipeIngredients->setQuantityUs($ingredient['quantity_us'])
                ->setQuantityMetric($ingredient['quantity_metric'])
                ->setUnitUs($ingredient['unit_us'])
                ->setUnitMetric($ingredient['unit_metric']);
            $ingredients[] = $recipeIngredients;
        }

        return $ingredients;

    }

}