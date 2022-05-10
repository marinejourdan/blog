<?php
namespace App\Controller;

class BaseController{


    function redirect(string $url){
        header('Location:'.$url);
        exit();
    }
}
