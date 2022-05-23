<?php
namespace App\Manager;

use App\Entity\User;
use App\Manager\PostManager;
use App\Manager\UserManager;

class UserManager extends BaseManager{

    const SQL_GET_LIST= <<<'SQL'
    SELECT id
    FROM user
    SQL;


    protected function create(array $row = []): User
    {

        $user=New User();

        $user->id = $row['id'];
        $user->name = $row['name'];
        $user->first_name = $row['first_name'];
        $user->nickname = $row['nickname'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->access = $row['access'];
        $user->enabled = $row['enabled'];

        return $user;
    }

    const SQL_GET = <<<'SQL'
    SELECT id, name, first_name, nickname, email, password, access,enabled
    FROM user
    WHERE id=:id
    SQL;


    const SQL_INSERT = <<<'SQL'
    INSERT INTO `user` (`name`, `first_name`, `nickname`, `email`,`password`,`access`,`enabled`)
    VALUES (:name, :first_name, :nickname,:email, :password, :access, :enabled)
    SQL;

    public function insert(User $user): bool
    {
        $db=$this->dbconnect();
        $result_prepare=$db->prepare(self::SQL_INSERT);
        $result_prepare->bindValue(':name', $user->name);
        $result_prepare->bindValue(':first_name', $user->first_name);
        $result_prepare->bindValue(':nickname',$user->nickname);
        $result_prepare->bindValue(':email', $user->email);
        $result_prepare->bindValue(':password', $user->password);
        $result_prepare->bindValue(':access', $user->access);
        $result_prepare->bindValue(':enabled', $user->enabled);

        $result=$result_prepare->execute();
        return $result;
    }

    const SQL_UPDATE= <<<'SQL'
    UPDATE user SET name =:name, first_name=:first_name,
    nickname=:nickname, email=:email, password=:password, access=:access, enabled=:enabled
    WHERE id=:id;
    SQL;

    public function update(User $user) :bool
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_UPDATE);
        $statement->bindValue(':id', $user->id);
        $statement->bindValue(':name',$user->name);
        $statement->bindValue(':first_name',$user->first_name);
        $statement->bindValue(':nickname', $user->nickname);
        $statement->bindValue(':email', $user->email);
        $statement->bindValue(':password', $user->password);
        $statement->bindValue(':access', $user->access);
        $statement->bindValue(':enabled', $user->enabled);
        $result=$statement->execute();

        return $result;
    }

    const SQL_DELETE= <<<'SQL'
    DELETE FROM `user`
    WHERE id=:id;
    SQL;

    public function delete(User $user): bool
    {

        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_DELETE);
        $statement->bindValue(':id', $user->id);
        $id=$user->id;
        $result=$statement->execute();

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
        return $user;
    }

}
