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
        $statement->execute();
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        $object=$this->create($row);

        return $object;
    }


    public function delete($object): bool
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(static::SQL_DELETE);
        $statement->bindValue(':id', $object->id);
        $result=$statement->execute();

        return $result;
    }


    public function update($object) :bool
    {
       $db=$this->dbconnect();
       $statement=$db->prepare(self::SQL_UPDATE);
       $statement=$this->bindValues();
       $result=$statement->execute();

       return $result;
    }

}
