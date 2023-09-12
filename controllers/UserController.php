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
    public function addUser()
    {
        $password = 'Mighty_Thanos';
        $password2 = 'Tony_Stark';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $hashedPassword2 = password_hash($password2, PASSWORD_DEFAULT);
        $user = new UserEntity('Thanos', 'fingersnap12@yahoo.com', $hashedPassword);
        // $user = new UserEntity('Ironman', 'im_ironman@@starkenterprises.com', $hashedPassword2);
        $this->userManager->insertUser($user);
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
    public function login(): bool
    {
        $emailOrUsername = $_GET['username'];
        $userPassword = $_GET['password'];
        $isUserVerified = $this->verifyUser($emailOrUsername, $userPassword);
        return $isUserVerified;
    }
}