<?php
namespace App\Controller;

class BaseController{

    const BASE_PATH = 'view/public/';
    const LAYOUT_VIEW = 'layout.html.php';
    const ADMIN_LAYOUT_VIEW='layoutAdmin.html.php';
    const ADMIN_BASE_PATH = 'view/admin/';

    public function redirect(string $url){
        header('Location:'.$url);
        exit;
    }

    public function render(string $viewFilePath, array $params = [])
    {
        ob_start();
        include_once (static::BASE_PATH.$viewFilePath);
        $content=ob_get_clean();
        include_once (static::BASE_PATH.static::LAYOUT_VIEW);
    }

    public function renderAdmin(string $viewFilePath, array $params = [])
    {
        ob_start();
        include_once (static::ADMIN_BASE_PATH .$viewFilePath);
        $content=ob_get_clean();
        include_once (static::ADMIN_BASE_PATH .static::ADMIN_LAYOUT_VIEW);
    }
}
