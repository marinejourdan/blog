<?php

namespace App\Manager;

class Db
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new \PDO('mysql:host='.$_ENV['SQLHOST'].';dbname='.$_ENV['DBNAME'], $_ENV['SQLLOGIN'], $_ENV['SQLPASS']);
        }

        return self::$instance;
    }
}
