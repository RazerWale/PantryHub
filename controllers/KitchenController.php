<?php
require_once('models/UserManager.php');
require_once('models/IngredientManager.php');



/**
 * Summary of MainPageController
 */
class KitchenController
{

    /**
     * Summary of recipeManager
     * @var RecipeManager
     */
    protected $recipeManager; // Attribute 
    /**
     * Summary of userManager
     * @var UserManager
     */
    protected $userManager; // Attribute 
    /**
     * Summary of userManager
     * @var IngredientManager
     */
    protected $ingredientManager;
    /**
     * Summary of userManager
     * @var EquipmentManager
     */
    protected $equipmentManager;


    //protected $ingredientManager;

    public function __construct() // Constructor 
    {
        $this->recipeManager = new RecipeManager();
        $this->userManager = new UserManager();
        $this->ingredientManager = new IngredientManager();
        $this->equipmentManager = new EquipmentManager();
    }

    public function kitchenPage()
    {
        $userId = $_SESSION['userId'];
        $userIngredients = $this->userManager->fetchUserIngredients($userId);
        $userEquipments = $this->userManager->fetchUserEquipments($userId);
        require_once('views/kitchen.php');
    }
    public function removeUserIngredient()
    {
        $userId = $_SESSION['userId'];
        var_dump($_POST);
        $ingredientId = $_POST['id'];

        $this->userManager->deleteUserIngredient($userId, $ingredientId);
        var_dump($ingredientId);
    }
    public function removeUserEquipment()
    {
        $userId = $_SESSION['userId'];
        $ingredientId = $_POST['id'];
        $this->userManager->deleteUserEquipment($userId, $ingredientId);
    }
}