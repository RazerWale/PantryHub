<?php

class TestController
{

    public function default()
    {
        require_once('views/main.php');
    }
    public function test()
    {
        require_once('views/test.php');
    }
    public function register()
    {
        require_once('views/register.php');
    }
    public function login()
    {
        require_once('views/login.php');
    }
    public function profilePage()
    {
        require_once('views/profile.php');
    }
    public function recipePage()
    {
        require_once('views/recipe.php');
    }
}
