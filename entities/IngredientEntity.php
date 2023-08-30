<?php

class IngredientEntity
{
    // Attributes

    protected ?int $id;
    protected string $name;
    protected ?string $imageUrl;
    protected ?int $calories;
    protected ?string $type;

    // Constructor

    public function __construct(
        string $name,
        int $id = null,
        string $imageUrl = null,
        int $calories = null,
        string $type = null
    ) {
        $this->setId($id)
            ->setName($name)
            ->setImageUrl($imageUrl)
            ->setCalories($calories)
            ->setType($type);


    }

    // Functions

    // Id

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

    // Ingredient name

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



    // Image


    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl 
     * @return self
     */
    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    // Calories


    /**
     * @return int|null
     */
    public function getCalories(): ?int
    {
        return $this->calories;
    }

    /**
     * @param int|null $calories 
     * @return self
     */
    public function setCalories(?int $calories): self
    {
        $this->calories = $calories;
        return $this;
    }

    // Type


    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type 
     * @return self
     */
    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }










}