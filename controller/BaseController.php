<?php
namespace App\Manager;

class BaseController{


    function redirect(string $url){
        header('Location:'.$url);
        exit();

    }
}
