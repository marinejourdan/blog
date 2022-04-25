<?php
namespace App\Manager;

class BaseManager{

    // Connect to DB and return DB resource
    private function dbconnect(){

        $db = new PDO('mysql:host=localhost;dbname=blog_test;charset=utf8','user','mdp');
        return $db;
    }
}
