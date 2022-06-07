<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;

class UserController extends BaseController
{
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function displayLogin()
    {
        $this->render(
        'displayLogin.html.php',
            []
        );
    }

    public function displayRegister()
    {
        $this->render(
            'displayRegister.html.php',
            []
        );
    }

    public function doRegister()
    {
        $errors = [];
        $valid = [];

        if (count($_POST) > 0) {
            $errors = [];
            $name = $_POST['name'];
            $first_name = $_POST['first_name'];
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $plainPassword = $_POST['password'];
            $passwordVerify = $_POST['passwordVerify'];

            if (
                empty($name) ||
                empty($first_name) ||
                empty($nickname) ||
                empty($email) ||
                empty($plainPassword) ||
                empty($passwordVerify)
            ) {
                $errors[] = 'register.missing_fields';
            }

            if ($plainPassword !== $passwordVerify) {
                $errors[] = 'not.same.password';
            }

            if ($this->userManager->findUserByEmail($email)) {
                $errors[] = 'register.already_account';
            }

            if (count($errors) > 0) {
                $_SESSION['errors'] = $errors;
                $this->redirect('index.php?controller=user&action=displayRegister');
            }else{
                $user = new User();
                $user->setName($name);
                $user->setFirstName($first_name);
                $user->setNickname($nickname);
                $user->setEmail($email);
                $user->setPassword(password_hash($plainPassword, PASSWORD_DEFAULT));

                $result = $this->userManager->insert($user);
                $valid[] = 'register.user';

                $_SESSION['valid'] = $valid;
                $this->redirect('./index.php?controller=user&action=displayLogin');
            }
        }
    }

    public function doLogin()
    {
        $errors = [];

        if (count($_POST) > 0) {
            if (
                !isset($_POST['email']) ||
                '' == $_POST['email']
            ) {
                $errors[] = 'login.no_mail';
            }

            $email = $_POST['email'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'login.email_invalid';
            } else {
                $_SESSION['last_email'] = $email;
            }

            if (
                !isset($_POST['password']) ||
                '' == $_POST['password']
            ) {
                $errors[] = 'login.no_pass';
            }

            $plainPassword = $_POST['password'];

            if (count($errors) > 0) {
                $_SESSION['errors'] = $errors;
                $this->redirect('index.php?controller=home&action=displayList');
            }

            $user = $this->userManager->findUserByEmail($email);

            if (
                null === $user ||
                !password_verify($plainPassword, $user->getPassword())
            ) {
                $errors[] = 'login.no_account';
            } elseif (!$user->getEnabled()) {
                $errors[] = 'login.waiting_account';
            }

            if (count($errors) > 0) {
                $_SESSION['errors'] = $errors;
                $this->redirect('index.php?controller=user&action=displayLogin');
            }

            $_SESSION['email'] = $user->getEmail();

            $this->redirect('index.php?controller=home&action=displayHome');
        }
    }

    public function doLogout()
    {
        if (isset($_SESSION['email'])) {
            session_destroy();
            $this->redirect('index.php?controller=user&action=displayLogin');
        }
    }

    public function accessAdmin()
    {
        $errors = [];
        if (!isset($_SESSION['email'])) {
            $this->redirect('index.php?controller=home&action=displayHome');
        }
        $email = ($_SESSION['email']);
        $user = $this->userManager->findUserByEmail($email);

        if (1 == $user->access) {
            $this->redirect('index.php?controller=admin&action=displayAdminHome');
        } else {
            $errors[] = 'login.no access';
            $_SESSION['errors'] = $errors;
            $this->redirect('index.php?controller=user&action=displayLogin');
        }
    }
}
