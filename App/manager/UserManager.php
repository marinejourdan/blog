<?php

namespace App\Manager;

use App\Entity\User;


class UserManager extends BaseManager
{
    public const SQL_GET_LIST = <<<'SQL'
    SELECT id
    FROM user
    WHERE 1
    ORDER BY id DESC
    SQL;

    public const SQL_GET = <<<'SQL'
    SELECT id, name, first_name, nickname, email, password, access,enabled
    FROM user
    WHERE id=:id
    SQL;

    public const SQL_INSERT = <<<'SQL'
    INSERT INTO `user` (`name`, `first_name`, `nickname`, `email`,`password`,`access`,`enabled`)
    VALUES (:name, :first_name, :nickname,:email, :password, :access, :enabled)
    SQL;

    public const SQL_UPDATE = <<<'SQL'
    UPDATE user SET name =:name, first_name=:first_name,
    nickname=:nickname, email=:email, password=:password, access=:access, enabled=:enabled
    WHERE id=:id;
    SQL;

    public function createObject(array $row = []): User
    {
        $user = new User();
        $user->hydrate($row);

        return $user;
    }

    public function bindValues($statement, User $user)
    {
        if ($user->getId()) {
            $statement->bindValue(':id', $user->getId());
        }
        $statement->bindValue(':name', $user->getName());
        $statement->bindValue(':first_name', $user->getFirstName());
        $statement->bindValue(':nickname', $user->getNickname());
        $statement->bindValue(':email', $user->getEmail());
        $statement->bindValue(':password', $user->getPassword());
        $statement->bindValue(':access', $user->getAccess());
        $statement->bindValue(':enabled', $user->getEnabled());

        return $statement;
    }

    public const SQL_DELETE = <<<'SQL'
    DELETE FROM `user`
    WHERE id=:id;
    SQL;

    public const SQL_FIND_USER = <<<'SQL'
    SELECT * FROM user WHERE email=:email LIMIT 1;
    SQL;

    public function findUserByEmail(string $email): ?User
    {
        $db = $this->dbconnect();
        $result_prepare = $db->prepare(self::SQL_FIND_USER);
        $result_prepare->bindValue(':email', $email);
        $result_prepare->execute();
        $user = null;
        if ($row = $result_prepare->fetch(\PDO::FETCH_ASSOC)) {
            $user = $this->createObject($row);
        }

        return $user;
    }
}
