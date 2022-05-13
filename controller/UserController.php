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
        "./view/public/displayLogin.html.php",
            [

            ]
        );

    }


    // index.php?controller=user&action=displayRegister
    function displayRegister(){

        $this->render(
        "./view/public/displayRegister.html.php",
            [

            ]
        );

    }



    function doRegister(){


        if(count($_POST)>0){
            $name=$_POST['name'];
            $first_name=$_POST['first_name'];
            $nickname=$_POST['nickname'];
            $email=$_POST['email'];
            $plainPassword=$_POST['password'];
            $access=$_POST['access'];
            $enabled=$_POST['enabled'];

            if (
                empty($name) ||
                empty($first_name)||
                empty($nickname)||
                empty($email)||
                empty($plainPassword)
            ){
                echo 'merci de renseigner un contenu';

            }else{

                $user=new User;
                $user->name=$name;
                $user->first_name=$first_name;
                $user->nickname=$nickname;
                $user->email=$email;
                $user->password=password_hash($plainPassword, PASSWORD_DEFAULT);
                $user->enabled=$enabled;

                $result=$this->userManager->insert($user);
                $this->redirect('./index.php?controller=user&action=displayLogin');

            }
        }
        //$this->redirect('./index.php?controller=post&action=displayList');
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

            $plainPassword=$_POST['password'];

            if(count($errors)>0){
                $_SESSION['errors']=$errors;
                $this->redirect('index.php?controller=home&action=displayList');
            }

            $user = $this->userManager->findUserByEmail($email);

            if(
                $user==null ||
                password_verify($plainPassword, $user->password)
            ){
                $errors[]='ce compte est inexistant';

            }

            if(count($errors)>0){
                $_SESSION['errors']=$errors;
                $this->redirect('index.php?controller=user&action=displayLogin');

            }

            $_SESSION['email']=$user->email;
            $this->redirect('index.php?controller=admin&action=displayAdminHome');
        }
    }

    function doLogout(){

        if(isset($_SESSION['email'])){
        session_destroy();
        $this->redirect('index.php?controller=user&action=displayLogin');
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
