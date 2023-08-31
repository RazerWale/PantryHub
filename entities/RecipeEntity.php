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

	/**
	 * Array of cuisine types
	 * @var array
	 */
	public const CUISINE_TYPES = ['African', 'Asian', 'American', 'British', 'Cajun', 'Caribbean', 'Chinese', 'Eastern European', 'European', 'French', 'German', 'Greek', 'Indian', 'Irish', 'Italian', 'Japanese', 'Jewish', 'Korean', 'Latin American', 'Mediterranean', 'Mexican', 'Middle Eastern', 'Nordic', 'Southern', 'Spanish', 'Thai', 'Vietnamese'];

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
		int $calories = null
	) {
		$this->setId($id)
			->setName($name)
			->setImageUrl($imageUrl)
			->setCuisineTypes($cuisineType)
			->setMealTypes($mealType)
			->setDiets($diets)
			->setTimeToCook($timeToCook)
			->setServings($servings)
			->setCalories($calories);

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

		foreach ($cuisineTypes as $type) {
			if (in_array($type, RecipeEntity::CUISINE_TYPES)) {
				$this->cuisineTypes = $cuisineTypes;

			} else {
				throw new Exception;
			}

		}
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










}