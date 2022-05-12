<?php
namespace App\Controller;

use App\Manager\BaseManager;
use App\Manager\UserManager;
use App\Manager\PostManager;
use App\Entity\User;

class UserController extends BaseController{

    private $userManager;


    public function __construct(UserManager $userManager){
       $this->userManager=$userManager;
   }

    // index.php?controller=user&action=displayLogin
    function displayLogin(){

        $this->render(
        "./view/displayLogin.html.php",
            [

            ]
        );

    }


    // index.php?controller=user&action=displayRegister
    function displayRegister(){
        $id_post = $_GET['id']; // A ne pas oublier qd tu vas générer l'URL
        die('youhou2');
    }


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

                $this->redirect('index.php?controller=admin&action=displayLogin');
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
                $this->redirect('index.php?controller=admin&action=displayLogin');
            }

            $_SESSION['email']=$user->email;
            $this->redirect('index.php?controller=admin&action=displayAdminHome');
        }
    }

    function doLogout(){

        if(isset($_SESSION['email'])){
        session_destroy();
        $this->redirect('index.php?controller=admin&action=displayLogin');
        }
    }

    function accessAdmin(){
        if(!isset($_SESSION['email'])){
        $this->redirect('index.php?controller=user&action=displayLogin');
        }
        $email=($_SESSION['email']);
        $user = $this->userManager->findUserByEmail($email);
        var_dump($user);

        if($user->access==0){
            $this->redirect('index.php?controller=admin&action=displayAdminHome');
        }else{
            echo 'vous navez pas accès à cette page';
        }
    }


}
