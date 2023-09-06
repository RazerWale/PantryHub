<?php

class UserEntity
{

    protected ?int $id;
    protected string $username;
    protected string $email;
    protected string $password;
    protected ?DateTime $createdAt;
    protected array $ingredients;
    protected array $equipments;
    protected array $ownRecipes;
    protected array $favouriteRecipes;
    protected array $ratedRecies;


    // Constructor 

    public function __construct(
        string $username,
        string $email,
        string $password,
        int $id = null,
        DateTime $createdAt = null
    ) {
        $this->setId($id)
            ->setUsername($username)
            ->setEmail($email)
            ->setPassword($password)
            ->setCreatedAt($createdAt);
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

    // UserName

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username 
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    // Email

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email 
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    // Password 

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password 
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    // DateTime


    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt 
     * @return self
     */
    public function setCreatedAt(?DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    // UsersIngredientsEntity (extends IngredientEnity)
    /**
     * @return UsersIngredientsEntity[]
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * @param UsersIngredientsEntity[] $ingredients 
     * @return self
     */
    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;
        return $this;
    }

    // EquipmentEntity

    /**
     * @return EquipmentEntity[]
     */
    public function getEquipments(): array
    {
        return $this->equipments;
    }

    /**
     * @param EquipmentEntity[] $equipments 
     * @return self
     */
    public function setEquipments(array $equipments): self
    {
        $this->equipments = $equipments;
        return $this;
    }

    // Own recipes

    /**
     * @return RecipeEntity[]
     */
    public function getOwnRecipes(): array
    {
        return $this->ownRecipes;
    }

    /**
     * @param RecipeEntity[] $ownRecipes 
     * @return self
     */
    public function setOwnRecipes(array $ownRecipes): self
    {
        $this->ownRecipes = $ownRecipes;
        return $this;
    }

    // FavouriteRecipes

    /**
     * @return RecipeEntity[]
     */
    public function getFavouriteRecipes(): array
    {
        return $this->favouriteRecipes;
    }

    /**
     * @param RecipeEntity[] $favouriteRecipes 
     * @return self
     */
    public function setFavouriteRecipes(array $favouriteRecipes): self
    {
        $this->favouriteRecipes = $favouriteRecipes;
        return $this;
    }

    // Rated Recipes 

    /**
     * @return RecipeRatingEntity[]
     */
    public function getRatedRecies(): array
    {
        return $this->ratedRecies;
    }

    /**
     * @param RecipeRatingEntity[] $ratedRecies 
     * @return self
     */
    public function setRatedRecies(array $ratedRecies): self
    {
        $this->ratedRecies = $ratedRecies;
        return $this;
    }
}