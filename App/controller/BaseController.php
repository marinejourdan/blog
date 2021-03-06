<?php

namespace App\Controller;

class BaseController
{
    public const BASE_PATH = 'view/public/';
    public const LAYOUT_VIEW = 'layout.html.php';
    public const ADMIN_LAYOUT_VIEW = 'layoutAdmin.html.php';
    public const ADMIN_BASE_PATH = 'view/admin/';

    public function redirect(string $url)
    {
        header('Location:'.$url);
    }

    public function render(string $viewFilePath, array $params = [])
    {
        ob_start();
        include_once static::BASE_PATH.$viewFilePath;
        $content = ob_get_clean();
        include_once static::BASE_PATH.static::LAYOUT_VIEW;
    }

    public function renderAdmin(string $viewFilePath, array $params = [])
    {
        ob_start();
        include_once static::ADMIN_BASE_PATH.$viewFilePath;
        $content = ob_get_clean();
        include_once static::ADMIN_BASE_PATH.static::ADMIN_LAYOUT_VIEW;
    }
}
