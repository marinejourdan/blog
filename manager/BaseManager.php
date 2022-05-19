<?php
namespace App\Manager;

class BaseManager{

    protected function dbconnect(){
        $db = new \PDO("mysql:host=".$_ENV['SQLHOST'].";dbname=".$_ENV['DBNAME'], $_ENV['SQLLOGIN'], $_ENV['SQLPASS']);
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
            $object=$this->get($row['id']);
            $object_list[] = $object;
        }
        return $object_list;
    }

    public function get($id): object
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(static::SQL_GET);
        $statement->bindValue(':id', $id);
        if(!$statement->execute()){
            var_dump($statement->errorInfo());
            die('ERROR');
        }

        if(!$row = $statement->fetch(\PDO::FETCH_ASSOC)){
            var_dump($this);
            die('ERROR : unknown object id '.$id);
        }

        $object=$this->create($row);

        return $object;
    }
}
