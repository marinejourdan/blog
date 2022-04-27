<?php
namespace App\Controller;

use App\Manager\UserManager;
use App\Manager\PostManager;

class UserController{

    private $userManager;

   public function __construct(UserManager $userManager){
       $this->userManager=$userManager;
   }

    // index.php?controller=user&action=displayLogin
    function displayLogin(){

        die('youhou');
    }

    // index.php?controller=user&action=displayRegister
    function displayRegister(){
        $id_post = $_GET['id']; // A ne pas oublier qd tu vas générer l'URL
        die('youhou2');
    }

    // index.php?controller=user&action=doRegister
    function doRegister(){

        die('youhou3');
    }

    // index.php?controller=user&action=doLogin
    function doLogin(){

        session_start();
        $errors = array();

        if(count($_POST)>0){

            $email=$_POST['email'];
            $password=$_POST['password'];

            if (empty($email)){
                $errors['email'] =  'merci de renseigner un mail';
            }

            if(empty($password)){
                $errors['password'] =  'merci de renseigner un mot de passe';
            }

            if(empty($errors)){

                $db = dbconnect();
                $sql= "SELECT id, password FROM user WHERE email=:email LIMIT 1;";
                $result_prepare=$db->prepare($sql);
                $result_prepare ->bindValue (':email',$email);
                $result_prepare->execute();
                $user=$result_prepare->fetch(PDO::FETCH_ASSOC);

                if (empty($user)){
                    $errors['user'] ='ce compte existe pas';
                }else{
                    if($password !== $user['password']){
                        $errors['user'] = 'ce compte existe pas ';
                    }

                }

            }
            $_SESSION['connexion_errors']=$errors;
            header('Location: /Controller/userController.php');
            exit();
        }
    }
}
