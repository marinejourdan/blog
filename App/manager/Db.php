<?php
namespace App\Manager;

class Db{

    private static $instance=NULL;

    private function __construct() {

    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new \PDO("mysql:host=".$_ENV['SQLHOST'].";dbname=".$_ENV['DBNAME'], $_ENV['SQLLOGIN'], $_ENV['SQLPASS']);
        }
        return self::$instance;

    }
}
