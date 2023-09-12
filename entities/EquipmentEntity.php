<?php

class EquipmentEntity
{

    protected ?int $id;
    protected string $name;
    protected string $image;
    protected array $recipes;

    public function __construct(string $name, int $id = null, string $image)
    {

        $this->setId($id)
            ->setName($name)
            ->setImage($image);

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

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image 
     * @return self
     */
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    // Recipe Entity

    /**
     * @return RecipeEntity[]
     */
    public function getRecipe(): array
    {
        return $this->recipes;
    }

    /**
     * @param RecipeEntity[] $recipes 
     * @return self
     */
    public function setRecipe(array $recipes): self
    {
        $this->recipes = $recipes;
        return $this;
    }


}