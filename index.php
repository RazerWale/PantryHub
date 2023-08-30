<?php


try {
    require_once('controllers/TestController.php');
    require_once('controllers/UserController.php');

    // controller here!
    $test = new TestController();

    $route = $_GET['action'] ?? null;

    switch ($route) {
        case 'test':
            $test->test();
            break;
        default:
            //should bring me to the home page
            $test->default();
            break;
    }
} catch (Throwable $e) {
    // displayError($e->getMessage());
    // echo $e->getMessage();
    throw $e;
    // die;
    // displayTheError($e);
}