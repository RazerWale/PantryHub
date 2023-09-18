<?php

class MainPageController
{
    public function default()
    {
        require_once('views/main.php');
    }
    public function profilePage()
    {
        $recipes = [];

        require_once('views/profile.php');
    }
    public function recipePage()
    {
        require_once('views/recipe.php');
    }
<<<<<<< HEAD
    public function kitchenPage()
    {
        require_once('views/kitchen.php');
    }
}
=======
}
>>>>>>> 85723fa31c9b4877119a9df199603adfcfe53642
