<?php

class EquipmentEntity
{

    protected ?int $id;
    protected string $name;
    protected array $recipe;

    public function __construct(string $name, int $id = null)
    {

        $this->setId($id)
            ->setName($name);

    }

    // Functions

    // ID

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id 
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    // Name s

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name 
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    // Recipe Entity

    /**
     * @return RecipeEntity[]
     */
    public function getRecipe(): array
    {
        return $this->recipe;
    }

    /**
     * @param RecipeEntity[] $recipe 
     * @return self
     */
    public function setRecipe(array $recipe): self
    {
        $this->recipe = $recipe;
        return $this;
    }
}