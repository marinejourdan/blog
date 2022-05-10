<?php
namespace App\Manager;

class BaseManager{

    protected function dbconnect(){
        $db = new \PDO('mysql:host=localhost;dbname=blog_test;charset=utf8','user','mdp');
        return $db;
    }
}
