<?php
namespace App\Manager;

class BaseManager{

    protected function dbconnect(){
        $db = new \PDO('mysql:host=localhost;dbname=blog_test;charset=utf8','user','mdp');
        return $db;
    }


    public function getList(): array
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(static::SQL_GET_LIST);
        $statement->execute();
        $data_list=$statement->fetchAll(\PDO::FETCH_ASSOC);
        $object_list = array();

        foreach($data_list as $row){
            $id=$row['id'];
            $object=$this->get($id);
            $object_list[] = $object;//j'ajoute chaque objet post dans un tableau post object list au lieu des résultats de fetch all/
        }

        return $object_list;
    }

    public function get($id): object
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(static::SQL_GET);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        $object=$this->create($row);

        return $object;
    }
}


// private static $dbName = 'nom_de_la_base_de_données';
// private static $dbHost = 'localhost';
// private static $dbUsername = 'nom_d’utilisateur';
// private static $dbUserPassword = 'mot_de_passe';
//
// private static $cont = null;
//
// public function __construct() {
// die('Fonction Init non autorisée');
// }
// public static function connect() {
// // Autoriser une seule connexion pour toute la durée de l’accès
// if ( null == self::$cont )
// {
//   try
//   {
//     self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
//   }
//   catch(PDOException $e)
//   {
//     die($e->getMessage());
//   }
// }
// return self::$cont;
// }
//
// public static function disconnect()
// {
// self::$cont = null;
// }
// }
