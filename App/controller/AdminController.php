<?php

namespace App\Controller;

class AdminController extends BaseController
{
    public const BASE_PATH = 'view/admin/';
    public const LAYOUT_VIEW = 'layoutAdmin.html.php';

    public function displayAdminHome()
    {
        $this->render(
            'displayAdminHome.html.php',
            []
        );
    }
}
