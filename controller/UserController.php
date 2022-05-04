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
        include_once ("./view/displayLogin.html.php");
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

            if (
                !isset($_POST['email']) ||
                $_POST['email'] == ''
            ){
                $errors[] =  'merci de renseigner un mail';
            }
            $email=$_POST['email'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse email '$email' n'est pas valide.";
            }else{
                $_SESSION['last_email']=$email;
            }

            if (
                !isset($_POST['password']) ||
                $_POST['password'] == ''
            ){
                $errors[] =  'merci de renseigner un mot de passe';
            }
            $password=$_POST['password'];

            if(count($errors)>0){
                $_SESSION['errors']=$errors;
                header('location: index.php?controller=user&action=displayLogin');
                exit();
            }

            $user = $this->userManager->findUserByEmail($email);

            if(
                $user==null ||
                $user->password!=$password
            ){
                $errors[]='ce compte est inexistant';

            }

            if(count($errors)>0){
                $_SESSION['errors']=$errors;
                header('location: index.php?controller=user&action=displayLogin');
                exit();
            }

            $_SESSION['email']=$user->email;
            header('location: index.php?controller=admin&action=displayAdminHome');
            exit();

        }
    }

    function doLogout(){

        if(isset($_SESSION['email'])){
        session_destroy();
        header('location: index.php?controller=user&action=displayLogin');
        exit();
        }
    }

    function accessAdmin(){
        if(!isset($_SESSION['email'])){
        header('location: index.php?controller=user&action=displayLogin');
        exit();
        }
        $email=($_SESSION['email']);
        $user = $this->userManager->findUserByEmail($email);
        var_dump($user);

        if($user->access==0){
            header('location: index.php?controller=user&action=displayAdminHome');
            exit();
        }else{
            echo 'vous navez pas accès à cette page';
        }
    }

    
}
