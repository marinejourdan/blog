<?php
namespace App\Controller;

class AdminController extends BaseController{

    const BASE_PATH = 'view/admin/';
    const LAYOUT_VIEW = 'layoutAdmin.html.php';

    function displayAdminHome(){

        $this->render(
            "displayAdminHome.html.php",
            []
        );
    }
}
