<?php
namespace App\Manager;

use App\Entity\User;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Entity\Comment;

class UserManager extends BaseManager{

    const SQL_GET_LIST= <<<'SQL'
    SELECT id
    FROM user
    SQL;

    const SQL_GET = <<<'SQL'
    SELECT id, name, first_name, nickname, email, password, access,enabled
    FROM user
    WHERE id=:id
    SQL;


    const SQL_INSERT = <<<'SQL'
    INSERT INTO `user` (`name`, `first_name`, `nickname`, `email`,`password`,`access`,`enabled`)
    VALUES (:name, :first_name, :nickname,:email, :password, :access, :enabled)
    SQL;

    const SQL_UPDATE= <<<'SQL'
    UPDATE user SET name =:name, first_name=:first_name,
    nickname=:nickname, email=:email, password=:password, access=:access, enabled=:enabled
    WHERE id=:id;
    SQL;

    public function createObject(array $row=[]): User
    {
        $user=new User;
        $user->hydrate($row);
        return $user;
    }

    public function bindValues($statement, User $user)
    {
        $statement->bindValue(':id', $user->getId());
        $statement->bindValue(':name',$user->getName());
        $statement->bindValue(':first_name',$user->getFirstName());
        $statement->bindValue(':nickname', $user->getNickname());
        $statement->bindValue(':email', $user->getEmail());
        $statement->bindValue(':password', $user->getPassword());
        $statement->bindValue(':access', $user->getAccess());
        $statement->bindValue(':enabled', $user->getEnabled());

        return $statement;
    }

    const SQL_DELETE= <<<'SQL'
    DELETE FROM `user`
    WHERE id=:id;
    SQL;

    const SQL_FIND_USER = <<<'SQL'
    SELECT * FROM user WHERE email=:email LIMIT 1;
    SQL;

    public function findUserByEmail(string $email): ?User
    {
        $db=$this->dbconnect();
        $result_prepare=$db->prepare(self::SQL_FIND_USER);
        $result_prepare ->bindValue (':email',$email);
        $result_prepare->execute();
        $user = null;
        if($row = $result_prepare->fetch(\PDO::FETCH_ASSOC)){
            $user=$this->createObject($row);
        }
        return $user;
    }
}
