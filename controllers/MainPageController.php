<?php

class MainPageController
{
    public function default()
    {
        require_once('views/main.php');
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
