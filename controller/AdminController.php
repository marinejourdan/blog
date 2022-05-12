<?php
namespace App\Controller;

class AdminController extends BaseController{

    function displayAdminHome(){

        $this->renderAdmin(
        "./view/admin/displayAdminHome.html.php",
        [

        ]
        );

    }

}
