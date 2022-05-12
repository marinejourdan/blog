<?php
namespace App\Controller;

class BaseController{


    public function redirect(string $url){
        header('Location:'.$url);
        exit();
    }

    public function render(string $viewPath, array $params = [])
    {

        ob_start();
        include_once ($viewPath);
        $content=ob_get_clean();
        include_once ("./layout.html.php");

    }

    public function renderAdmin(string $viewPath, array $params = [])
    {

        ob_start();
        include_once ($viewPath);
        $content=ob_get_clean();
        include_once ("./layoutAdmin.html.php");

    }
}
