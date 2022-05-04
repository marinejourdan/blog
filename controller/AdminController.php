<?php
namespace App\Controller;

class AdminController
{

    private $commentManager;
    private $userManager;
    private $postManager;

    public function __construct(CommentManager $commentManager, UserManager $userManager, PostManager $postManager ){
       $this->commentManager=$commentManager;
       $this->userManager=$userManager;
       $this->postManager=$postManager;
    }

    function displayAdminHome(){
        ob_start();
        include_once("./view/displayAdminHome.html.php");
        $content=ob_get_clean();


        include_once("./layoutAdmin.html.php");
    }



    function displayAdminList(){
        ob_start();
        include_once("./view/displayAdminHome.html.php");
        $content=ob_get_clean();


        include_once("./layoutAdmin.html.php");
    }

    function displayAdminCreate(){
        ob_start();
        include_once("./view/displayAdminHome.html.php");
        $content=ob_get_clean();


        include_once("./layoutAdmin.html.php");
    }

    function displayAdminUpdate(){
        ob_start();
        include_once("./view/displayAdminHome.html.php");
        $content=ob_get_clean();


        include_once("./layoutAdmin.html.php");
    }

    function doAdminUpdate(){
        ob_start();
        include_once("./view/displayAdminHome.html.php");
        $content=ob_get_clean();


        include_once("./layoutAdmin.html.php");
    }

    function doAdminDelete(){
        ob_start();
        include_once("./view/displayAdminHome.html.php");
        $content=ob_get_clean();


        include_once("./layoutAdmin.html.php");
    }
}
