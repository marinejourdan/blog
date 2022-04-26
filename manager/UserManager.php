<?php
namespace App\Manager;

use App\Entity\User;
class UserManager extends BaseManager{


    public function getUserList(): array {

        $db=$this->dbconnect();
        $sql ="SELECT id FROM user;";
        $result=$db->query($sql);
        $tous_les_users=$result->fetchAll(\PDO::FETCH_ASSOC);

        $users_object_list = array();

        foreach($tous_les_users as $un_user_sous_forme_de_tableau){
            $id_user=$un_user_sous_forme_de_tableau['id'];
            $user=getUser($id_user);
            $user_object_list[] = $user;
        }

    return $user_object_list;
    }

    public function getUser(int $id_user): User
    {
        $db=$this->dbconnect();
        $sql ="SELECT id, name, first_name, nickname, email FROM user WHERE id=$id_user ;";
        $result=$db->query($sql);
        $tableau_user=$result->fetch(\PDO::FETCH_ASSOC);

        $user=New User();

        $user->id_user = $tableau_user ['id'];
        $user->name = $tableau_user ['name'];
        $user->first_name = $tableau_user ['first_name'];
        $user->nickname = $tableau_user ['nickname'];
        $user->email = $tableau_user ['email'];
        //$user->password = $tableau_user['password'];


        return $user;
    }

    public function insertUser(User $user): bool
    {
        $db=$this->dbconnect();
        $sql = "INSERT INTO `user` (`name`, `first_name`, `nickname`, `email`,`password` )
                    VALUES (:name, :first_name, :nickname,:email, :password);";

        $result_prepare=$db->prepare($sql);
        $result_prepare->bindValue(':name', $user->name);
        $result_prepare->bindValue(':first_name', $user->first_name);
        $result_prepare->bindValue(':nickname',$user->nickname);
        $result_prepare->bindValue(':email', $user->email);
        $result_prepare->bindValue(':password', $user->password);

        $result=$result_prepare->execute();

        if(!$result){
            var_dump($result_prepare->errorInfo());
            die('ERROR');
        }

        return $result;
    }


    public function updateUser(User $user) :bool
    {
        $db=$this->dbconnect();
        $sql = "UPDATE user SET name='$user->name', first_name='$user->first_name', nickname='$user->nickname', email='$user->email',password='$user->password'
                    WHERE id=$user->id_user;";
        $result=$user->id_user;
        $result=$db->exec($sql);


        if(!$result){
            die('ERROR');
        }
        return $result;
    }


    public function deletUser(User $user): bool
    {
        $db=$this->dbconnect();
        $sql="DELETE FROM `user` WHERE id=$user->id_user";
        $result=$user->id_user;
        $result=$db->exec($sql);
        if(!$result){

            die('ERROR');
        }

        return $result;
    }
}
