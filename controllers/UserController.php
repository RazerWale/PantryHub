<?php

require_once('models/UserManager.php');

class UserController
{
    protected $userManager;
    public function __construct()
    {
        $this->userManager = new UserManager();
    }
    public function getUser()
    {
        $id = 1;
        $user = $this->userManager->fetchUser($id);
        require_once('views/main.php');
    }
    public function listUsers()
    {
        $user = $this->userManager->fetchUsers();
        require_once('views/main.php');
    }
    public function registerUser()
    {
        if (!empty($_POST)) {
            try {

                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $passwordConfirm = $_POST['passCon'];
                if ($passwordConfirm !== $password) {
                    throw new Exception('Your password and confirmation password do not match');
                }
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $user = new UserEntity($username, $email, $hashedPassword);
                $this->userManager->insertUser($user);
                require_once('views/login.php');
            } catch (Exception $e) {
                echo $e->getMessage(); // if user or email already exist, it will throw exeption
            }
        }
        require_once('views/register.php');
    }
    public function login()
    {
        if (!empty($_POST)) {
            $emailOrUsername = $_POST['useremail'];
            $userPassword = $_POST['password'];
            $isUserVerified = $this->verifyUser($emailOrUsername, $userPassword);
            if ($isUserVerified) {
                $user = $this->userManager->fetchUserByEmailOrUsername($emailOrUsername);
                $userId = $user->getId();
                $userName = $user->getUsername();
                setcookie('user', $userName);
                setcookie('id', $userId);
                $_SESSION['loggedIn'] = true;
                $_SESSION['userName'] = $userName;
                $_SESSION['userId'] = $userId;

                header('Location: ?action=profilePage');
                exit;
            } else {
                echo 'incorrect username/email or password';
            }
        }
        // we need logout button
        if (isset($_GET['logOut'])) {
            session_destroy();
            setcookie("user", "", time() - 3600);
            setcookie("id", "", time() - 3600);
        }

        require_once('views/login.php');
    }
    public function removeUser()
    {
        $id = 1;
        $this->userManager->deleteUser($id);
        require_once('views/main.php');
    }

    public function verifyUser(string $emailOrUsername, string $userPassword): bool
    {
        $user = $this->userManager->fetchUserByEmailOrUsername($emailOrUsername);
        if ($user == null) {
            return false;
        }
        $hashedPassword = $user->getPassword();
        return password_verify($userPassword, $hashedPassword);
    }
    public function addUserEquipment()
    {
        $id = 1;
        $equipments = [404629, 404645];
        foreach ($equipments as $equipment) {
            $this->userManager->insertUserEquipment($id, $equipment);
        }
    }
    public function getUserEquipments()
    {
        $id = 1;
        $userEquipment = $this->userManager->fetchUserEquipments($id);
    }
    public function removeUserEquipment()
    {
        $id = 1;
        $equipmentId = 404629;
        $this->userManager->deleteUserEquipment($id, $equipmentId);
    }
    public function addUserIngredient()
    {
        $userIngredients = [
            ['userId' => 1, 'ingredientId' => 1009, 'quantity_us' => 212, 'quantity_metric' => 1000, 'unit_us' => 'pounds', 'unit_metric' => 'gramm'],
            ['userId' => 1, 'ingredientId' => 1119, 'quantity_us' => 2212, 'quantity_metric' => 2355, 'unit_us' => 'rocks', 'unit_metric' => 'litters']
        ];
        foreach ($userIngredients as $ingredient) {
            $userIngredients = new UsersIngredientsEntity('', $ingredient['ingredientId']);
            $userIngredients->setQuantityUs($ingredient['quantity_us'])
                ->setQuantityMetric($ingredient['quantity_metric'])
                ->setUnitUs($ingredient['unit_us'])
                ->setUnitMetric($ingredient['unit_metric']);
            $this->userManager->insertUserIngredient($ingredient['userId'], $userIngredients);
        }
    }
    public function getUserIngredients()
    {
        $id = 1;
        var_dump($this->userManager->fetchUserIngredients($id));
        require_once('views/main.php');
    }
    public function removeUserIngredient()
    {
        $id = 1;
        $ingredientId = 1009;
        $this->userManager->deleteUserIngredient($id, $ingredientId);
    }
    public function addUserFavouriteRecipe()
    {
        $id = 1;
        $favouriteRecipe = 157344;
        $this->userManager->insertUserFavouriteRecipe($id, $favouriteRecipe);
    }
    public function getUserFavouriteRecipes()
    {
        $id = 1;
        $userFavouriteRecipes = $this->userManager->fetchUserFavouriteRecipes($id);
    }
    public function removeFavouriteRecipe()
    {
        $id = 1;
        $favouriteRecipeId = 157344;
        $this->userManager->deleteUserFavouriteRecipe($id, $favouriteRecipeId);
    }
}