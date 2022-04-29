<?php
namespace App\Entity;

class Comment{

    public $id_comment = NULL;
    public $content = NULL;
    public $creation_date= NULL;
    public $id_post = NULL;
    public $id_user = NULL;
    
    public $nickname_user= NULL;
    public $post=NULL;
}
