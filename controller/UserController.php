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

        $errors[]=array();

        if(count($_POST)>0){
            $errors = array();
            $name=$_POST['name'];
            $first_name=$_POST['first_name'];
            $nickname=$_POST['nickname'];
            $email=$_POST['email'];
            $plainPassword=$_POST['password'];
            $access=$_POST['access'];
            $enabled=$_POST['enabled'];


            if ($user) {
                $errors[] = 'vous avez déjà un compte, merci de vous connecter';
            }

            if (
                empty($name) ||
                empty($first_name)||
                empty($nickname)||
                empty($email)||
                empty($plainPassword)
            ){
                $errors[] = 'merci de renseigner un contenu';

            if(count($errors)>0){
                $_SESSION['errors']=$errors;
                $this->redirect('index.php?controller=user&action=doRegister');
            }

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

            var_dump($user);
            if(
                $user==null ||
                !password_verify($plainPassword, $user->password)
            ){
                $errors[]='ce compte est inexistant';

            }

            if ($user->enabled==0){
                $errors[]='votre compte est en attente d activation, merci de patienter';
            }

            if(count($errors)>0){
                $_SESSION['errors']=$errors;
                $this->redirect('index.php?controller=user&action=displayLogin');

            }

            $_SESSION['email']=$user->email;
            $this->redirect('index.php?controller=home&action=displayHome');
        }
    }

    function doLogout(){

        if(isset($_SESSION['email'])){
        session_destroy();
        $this->redirect('index.php?controller=user&action=displayLogin');
        }
    }

    function accessAdmin(){

        $errors = array();


        if(!isset($_SESSION['email'])){
        $this->redirect('index.php?controller=home&action=displayHome');
        }
        $email=($_SESSION['email']);
        $user = $this->userManager->findUserByEmail($email);

        if($user->access==1){
            $this->redirect('index.php?controller=admin&action=displayAdminHome');
        }else{

            $errors[]= 'vous navez pas accès à cette page';
            $_SESSION['errors']=$errors;
            $this->redirect('index.php?controller=user&action=displayLogin');

        }
    }


}
