<?php

abstract class Manager // to be able to use this abstract class, you have to extend this in another class!
{

    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=recipe_project;charset=utf8', 'root', '');
        } catch (Exception $e) {
            throw new Exception('Error: ' . $e->getMessage());
        }
    }
}