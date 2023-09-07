<?php

require_once('Manager.php');
require_once('entities/IngredientEntity.php');

/**
 * Summary of IngredientManager
 */
class IngredientManager extends Manager
{
    /**
     * Summary of fetchIngredient
     * @param int $id
     * @return IngredientEntity
     */
    public function fetchIngredient(int $id): IngredientEntity
    {
        $req = $this->db->prepare('
        SELECT *
        FROM ingredients
        WHERE ingredients.id = ?
        ');
        $req->execute([$id]);
        $result = $req->fetch(PDO::FETCH_ASSOC);

        $ingredient = new IngredientEntity($result['name'], $result['id'], $result['image_url'], $result['calories'], $result['type']);
        var_dump($ingredient);
        return $ingredient;
    }

    /**
     * Summary of getIngredients
     * @return IngredientEntity[]
     */
    public function fetchIngredients(): array
    {
        $req = $this->db->query('
        SELECT *
        FROM ingredients
        ORDER BY name DESC  
        ');
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $ingredient = new IngredientEntity($row['name'], $row['id'], $row['image_url'], $row['calories'], $row['type']);
            $result[] = $ingredient;
        }
        return $result;
    }
    public function insertIngredient(IngredientEntity $ingredient)
    {
        $req = $this->db->prepare('
        INSERT INTO ingredients (name,
        image_url,
        calories,
        type)
        VALUES (?,?,?,?)
        ');
        $req->execute([$ingredient->getName(), $ingredient->getImageUrl(), $ingredient->getCalories(), $ingredient->getType()]);
    }
    public function deleteIngredient(int $id)
    {
        $req = $this->db->prepare('
        DELETE 
        FROM ingredients
        WHERE ingredients.id = ?
        ');
        $req->execute([$id]);
    }

    /**
     * Summary of fetchIngredientsForRecipe
     * @param int $id
     * @return RecipeIngredientsEntity[]
     */
    public function fetchIngredientsForRecipe(int $id): array
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