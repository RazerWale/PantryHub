<?php

class RecipeEntity
{
	// Attributes 
	protected ?int $id;
	protected string $name;
	protected ?string $imageUrl;
	protected array|null $cuisineTypes;
	protected array|null $mealTypes;
	protected array|null $diets;
	protected ?int $timeToCook;
	protected ?int $servings;
	protected ?int $calories;
	protected array $steps;
	protected ?DateTime $createdAt;
	protected array $ingredients;
	protected array $equipments;


	/**
	 * Array of cuisine types
	 * @var array
	 */
	public const CUISINE_TYPES = ['African', 'Asian', 'American', 'British', 'Cajun', 'Caribbean', 'Chinese', 'Eastern European', 'European', 'French', 'German', 'Greek', 'Indian', 'Irish', 'Italian', 'Japanese', 'Jewish', 'Korean', 'Latin American', 'Mediterranean', 'Mexican', 'Middle Eastern', 'Nordic', 'Southern', 'Spanish', 'Thai', 'Vietnamese'];

	/**
	 * Array of meal types
	 * @var array
	 */
	public const MEAL_TYPES = ['main course', 'side dish', 'dessert', 'appetizer', 'salad', 'bread', 'breakfast', 'soup', 'beverage', 'sauce', 'marinade', 'fingerfood', 'snack', 'drink'];

	/**
	 * Array of diets
	 * @var array
	 */
	public const DIETS = ['Gluten Free', 'Ketogenic', 'Vegetarian', 'Lacto Vegetarian', 'Ovo Vegetarian', 'Vegan', 'Pescetarian', 'Paleo', 'Primal', 'Low FODMAP', 'Whole30'];

	// Constructor
	public function __construct(
		string $name,
		int $id = null,
		string $imageUrl = null,
		array $cuisineType = null,
		array $mealType = null,
		array $diets = null,
		int $timeToCook = null,
		int $servings = null,
		int $calories = null,
		DateTime $createdAt = null
	) {
		$this->setId($id)
			->setName($name)
			->setImageUrl($imageUrl)
			->setCuisineTypes($cuisineType)
			->setMealTypes($mealType)
			->setDiets($diets)
			->setTimeToCook($timeToCook)
			->setServings($servings)
			->setCalories($calories)
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

	// Name 

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


	// Cuisine type ************

	/**
	 * @return array|null
	 */
	public function getCuisineTypes(): array|null
	{
		return $this->cuisineTypes;
	}

	/**
	 * @param array|null $cuisineTypes 
	 * @return self
	 */
	public function setCuisineTypes(array|null $cuisineTypes): self
	{
		if ($cuisineTypes === null) {
			$this->cuisineTypes = null;
			return $this;
		}

		foreach ($cuisineTypes as $type) {
			if (!in_array($type, RecipeEntity::CUISINE_TYPES)) {
				throw new Exception("Invalid cuisine type: $type");
			}
		}
		$this->cuisineTypes = $cuisineTypes;
		return $this;
	}

	// Meal type 

	/**
	 * @return array|null
	 */
	public function getMealTypes(): array|null
	{
		return $this->mealTypes;
	}

	/**
	 * @param array|null $mealTypes 
	 * @return self
	 */
	public function setMealTypes(array|null $mealTypes): self
	{
		if ($mealTypes === null) {
			$this->mealTypes = null;
			return $this;
		}

		foreach ($mealTypes as $type) {
			if (!in_array($type, RecipeEntity::MEAL_TYPES)) {
				throw new Exception("Invalid meal type: $type");
			}
		}
		$this->mealTypes = $mealTypes;
		return $this;
	}



	// Diets

	/**
	 * @return array|null
	 */
	public function getDiets(): array|null
	{
		return $this->diets;
	}

	/**
	 * @param array|null $diets 
	 * @return self
	 */
	public function setDiets(array|null $diets): self
	{
		if ($diets === null) {
			$this->diets = null;
			return $this;
		}

		foreach ($diets as $type) {
			if (!in_array($type, RecipeEntity::DIETS)) {
				throw new Exception("Invalid diet: $type");
			}
		}
		$this->diets = $diets;
		return $this;
	}

	// Time to cook 


	/**
	 * @return int|null
	 */
	public function getTimeToCook(): ?int
	{
		return $this->timeToCook;
	}

	/**
	 * @param int|null $timeToCook 
	 * @return self
	 */
	public function setTimeToCook(?int $timeToCook): self
	{
		$this->timeToCook = $timeToCook;
		return $this;
	}

	// Servings

	/**
	 * @return int|null
	 */
	public function getServings(): ?int
	{
		return $this->servings;
	}

	/**
	 * @param int|null $servings 
	 * @return self
	 */
	public function setServings(?int $servings): self
	{
		$this->servings = $servings;
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

	// Created at

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

	// Steps

	/**
	 * @return StepEntity[]
	 */
	public function getSteps(): array
	{
		return $this->steps;
	}

	/**
	 * @param StepEntity[] $steps 
	 * @return self
	 */
	public function setSteps(array $steps): self
	{
		$this->steps = $steps;
		return $this;
	}

	// Ingredients (RecipeIngredientsEntity extends IngredientEntity)

	/**
	 * @return RecipeIngredientsEntity[]
	 */
	public function getIngredients(): array
	{
		return $this->ingredients;
	}

	/**
	 * @param RecipeIngredientsEntity[] $ingredients 
	 * @return self
	 */
	public function setIngredients(array $ingredients): self
	{
		$this->ingredients = $ingredients;
		return $this;
	}

	// Equipments (EquipmentEntity)

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

}