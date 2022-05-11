<?php
namespace App\Manager;

use App\Entity\User;
use App\Manager\PostManager;
use App\Manager\UserManager;

class UserManager extends BaseManager{


    private function createFromDatabase($tableau_user){
        $user=New User();
        $user->id = $tableau_user ['id'];
        $user->name = $tableau_user ['name'];
        $user->first_name = $tableau_user ['first_name'];
        $user->nickname = $tableau_user ['nickname'];
        $user->email = $tableau_user ['email'];
        $user->password = $tableau_user ['password'];
        $user->access = $tableau_user ['access'];
        return $user;
    }


        const SQL_GET_USER_LIST = <<<'SQL'
        SELECT *
        FROM user;
        SQL;

    public function getList(): array {

        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_GET_USER_LIST);
        $statement->execute();
        $tous_les_users = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $user_object_list = array();

        foreach($tous_les_users as $un_user_sous_forme_de_tableau){
            $user=$this-> createFromDatabase($un_user_sous_forme_de_tableau);
            $user_object_list[] = $user;
        }

    return $user_object_list;
    }

    const SQL_GET_USER = <<<'SQL'
    SELECT id, name, first_name, nickname, email, password, access
    FROM user;
    WHERE id=:id
    SQL;


    public function get(int $id): User
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_GET_USER);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $tableau_user= $statement->fetch(\PDO::FETCH_ASSOC);

        $user=$this-> createFromDatabase($tableau_user);

        //$user->password = $tableau_user['password'];

        return $user;
    }

    const SQL_INSERT_USER = <<<'SQL'
    INSERT INTO `user` (`name`, `first_name`, `nickname`, `email`,`password`,`access` )
    VALUES (:name, :first_name, :nickname,:email, :password, :access);
    SQL;

    public function insert(User $user): bool
    {
        $db=$this->dbconnect();
        $result_prepare=$db->prepare(self::SQL_INSERT_USER);
        $result_prepare->bindValue(':name', $user->name);
        $result_prepare->bindValue(':first_name', $user->first_name);
        $result_prepare->bindValue(':nickname',$user->nickname);
        $result_prepare->bindValue(':email', $user->email);
        $result_prepare->bindValue(':password', $user->password);
        $result_prepare->bindValue(':access', $user->access);

        $result=$result_prepare->execute();

        if(!$result){
            var_dump($result_prepare->errorInfo());
            die('ERROR');
        }

        return $result;
    }

    const SQL_UPDATE_USER = <<<'SQL'
    UPDATE user SET name =:name, first_name=:first_name,
    nickname=:nickname, email=:email, password=:password, access=:access
    WHERE id=:id;
    SQL;

    public function update(User $user) :bool
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_UPDATE_USER);
        $statement->bindValue(':id', $user->id);
        $statement->bindValue(':name',$user->name);
        $statement->bindValue(':first_name',$user->first_name);
        $statement->bindValue(':nickname', $user->nickname);
        $statement->bindValue(':email', $user->email);
        $statement->bindValue(':password', $user->password);
        $statement->bindValue(':access', $user->access);
        $result=$statement->execute();

        if(!$result){
            var_dump($statement->errorInfo());
            die('ERROR');
        }
        return $result;
    }


    const SQL_DELET_USER= <<<'SQL'
    DELETE FROM `user`
    WHERE id=:id;
    SQL;

    public function delete(User $user): bool
    {

        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_DELET_USER);
        $statement->bindValue(':id', $user->id);
        $id=$user->id;
        $result=$statement->execute();

        if(!$result){
            var_dump($statement->errorInfo());
            die('ERROR');
        }

        return $result;
    }

    const SQL_FIND_USER = <<<'SQL'
    SELECT id FROM user WHERE email=:email LIMIT 1;
    SQL;

    public function findUserByEmail(string $email): ?User
    {
        $db=$this->dbconnect();
        $result_prepare=$db->prepare(self::SQL_FIND_USER);
        $result_prepare ->bindValue (':email',$email);
        $result_prepare->execute();
        $user_row=$result_prepare->fetch(\PDO::FETCH_ASSOC);

        $user=null;
        if (!empty($user_row)){
            $user=$this->get($user_row['id']);
        }
        return $user;
    }

}
