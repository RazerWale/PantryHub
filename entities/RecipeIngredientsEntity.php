<?php

require_once('IngredientEntity.php');

class RecipeIngredientsEntity extends IngredientEntity
{
    protected ?int $recipeIngredientId;
    protected ?float $quantityUs;
    protected ?float $quantityMetric;
    protected ?string $unitUs;
    protected ?string $unitMetric;


    /**
     * @return int|null
     */
    public function getRecipeIngredientId(): ?int
    {
        return $this->recipeIngredientId;
    }

    /**
     * @param int|null $recipeIngredientId 
     * @return self
     */
    public function setRecipeIngredientId(?int $recipeIngredientId): self
    {
        $this->recipeIngredientId = $recipeIngredientId;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getQuantityUs(): ?float
    {
        return $this->quantityUs;
    }

    /**
     * @param float|null $quantityUs 
     * @return self
     */
    public function setQuantityUs(?float $quantityUs): self
    {
        $this->quantityUs = $quantityUs;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getQuantityMetric(): ?float
    {
        return $this->quantityMetric;
    }

    /**
     * @param float|null $quantityMetric 
     * @return self
     */
    public function setQuantityMetric(?float $quantityMetric): self
    {
        $this->quantityMetric = $quantityMetric;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUnitUs(): ?string
    {
        return $this->unitUs;
    }

    /**
     * @param string|null $unitUs 
     * @return self
     */
    public function setUnitUs(?string $unitUs): self
    {
        $this->unitUs = $unitUs;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUnitMetric(): ?string
    {
        return $this->unitMetric;
    }

    /**
     * @param string|null $unitMetric 
     * @return self
     */
    public function setUnitMetric(?string $unitMetric): self
    {
        $this->unitMetric = $unitMetric;
        return $this;
    }


}