<?php

require_once('IngredientEntity.php');

class UsersIngredientsEntity extends IngredientEntity
{
    protected ?int $UserIngredientID;
    protected ?int $quantityUs;
    protected ?int $quantityMetric;
    protected ?string $unitUs;
    protected ?string $unitMetric;


    /**
     * @return int|null
     */
    public function getUserIngredientID(): ?int
    {
        return $this->UserIngredientID;
    }

    /**
     * @param int|null $UserIngredientID 
     * @return self
     */
    public function setUserIngredientID(?int $UserIngredientID): self
    {
        $this->UserIngredientID = $UserIngredientID;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantityUs(): ?int
    {
        return $this->quantityUs;
    }

    /**
     * @param int|null $quantityUs 
     * @return self
     */
    public function setQuantityUs(?int $quantityUs): self
    {
        $this->quantityUs = $quantityUs;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantityMetric(): ?int
    {
        return $this->quantityMetric;
    }

    /**
     * @param int|null $quantityMetric 
     * @return self
     */
    public function setQuantityMetric(?int $quantityMetric): self
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