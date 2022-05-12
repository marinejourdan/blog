<?php
namespace App\Controller;

class AdminController extends BaseController{

    function displayAdminHome(){

        $this->renderAdmin(
        "./view/displayAdminHome.html.php",
        [

        ]
        );

    }

}
