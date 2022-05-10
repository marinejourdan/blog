<?php
namespace App\Controller;

class AdminController extends BaseController{

    function displayAdminHome(){
        ob_start();
        include_once("./view/displayAdminHome.html.php");
        $content=ob_get_clean();
        include_once("./layoutAdmin.html.php");
    }

}
