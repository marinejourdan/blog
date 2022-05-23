<?php
namespace App\Controller;

class AdminController extends BaseController{

    const BASE_PATH = 'view/admin/';
    const LAYOUT_VIEW = 'layoutAdmin.html.php';

    public function displayAdminHome(){

        $this->render(
            "displayAdminHome.html.php",
            []
        );
    }
}
