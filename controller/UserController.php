<?php
namespace App\Controller;

use App\Manager\BaseManager;
use App\Manager\UserManager;
use App\Manager\PostManager;
use App\Entity\User;

class UserController{

    private $userManager;


    public function __construct(UserManager $userManager){
       $this->userManager=$userManager;
   }

    // index.php?controller=user&action=displayLogin
    function displayLogin(){
        ob_start();
        include_once ("./view/displayLogin.html.php");;
        $content=ob_get_clean();
        // Tt revient à la normal à partir d'ici
        // On "affiche" la structure html complète qui se charge de faire un echo $content
        // pour placer le contenu au bon endroit dans le html ;)
        include_once("./layout.html.php");
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

        $errors = array();

        if(count($_POST)>0){

            if (!isset($_POST['email'])){
                $errors['email'] =  'merci de renseigner un mail';
                echo $errors['email'];
                die();
            }
            $email=$_POST['email'];

            if ($email === '') {
                $errors['email'] =  'merci de renseigner un mail';
                echo $errors['email'];
                die();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'adresse email '$email' n'est pas valide.";
                echo $errors['email'];
                die();
            }

            if(!isset($_POST['password'])){
                $errors['password'] =  'merci de renseigner un mot de passe';
                echo $errors['password'];
                die();
            }
            $password=$_POST['password'];
            if ($password === '') {
                $errors['password'] =  'merci de renseigner un mot de passe';
                echo $errors['password'];
                die();
            }

            $user = $this->userManager->findUserByEmail($email);

            if ($user==null){
                $errors['email']='ce compte est inexistant';
                echo $errors['email'];
                die();
            }elseif($user->password==$password){
                $errors['password']='ce compte est inexistant';
                echo $errors['password'];
                die();
            }else{
                header('location: index.php?controller=home&action=displayHome');
            }

            //$_SESSION['connexion_errors']=$errors;

        }
    }
}
