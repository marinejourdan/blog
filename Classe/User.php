<?php

class User{

    public $id_user = NULL;
    public $name = NULL;
    public $first_name = NULL;
    public $nickname = NULL;
    public $email = NULL;
    public $access = NULL;
    public $password= NULL;

    //
    // function recupererUserFromDatabase(int $id){
    //     $db = new PDO('mysql:host=localhost;dbname=blog_test;charset=utf8','user','mdp');
    //     $sql ="SELECT id, name, first_name, nickname, email FROM user WHERE id=$id ;";
    //     $result=$db->query($sql);
    //     $row=$result->fetch(PDO::FETCH_ASSOC);
    //
    //     $this->id = $row['id'];
    //     $this->name = $row['name'];
    //     $this->first_name = $row['first_name'];
    //     $this->nickname = $row['nickname'];
    //     $this->email = $row['email'];
    //     // $this->acces = $row['acces'];
    //     // $this->password = $row['password'];
    //
    // }
    // public function afficherUser(){
    //     return $this->name." - ".$this->first_name." - ".$this->nickname." - ".$this->email." - ".$this->access;
    // }
    //
    // function insert_user($db){
    //     $db = new PDO('mysql:host=localhost;dbname=blog_test;charset=utf8','user','mdp');
    //     if (empty($this->name) || empty($this->first_name) || empty($this->surnom)| empty($this->email)| empty($this->password)) {
    //     		return false;
    //
    //     }else{
    //         " INSERT INTO `user` (`name`, `first_name`, `nickname`, `email`,`password`)
    //                   VALUES ('$name','$first_name', '$nickname','$email', '$password');";
    //         echo $sql .'</br>';
    //         $result_prepare=$db->exec($sql);
    //         $result_prepare=$db->prepare($sql);
    //         $result_prepare ->bindValue (':name',$nom);
    //         $result_prepare ->bindValue (':first_name',$prenom);
    //         $result_prepare ->bindValue (':nickname',$surnom);
    //         $result_prepare ->bindValue (':email',$email);
    //         $result_prepare ->bindValue (':password',$password);
    //
    //         $result=$result_prepare->exec();
    //     }
    // }
    //     function connexion($db,$email,$password){
    //         if (empty($this->email) || empty($this->password)) {
    //         		return false;
    //         }if(!isset($this->email)){
    //                 return false;
    //         }
    //
    //
    //     }

}
