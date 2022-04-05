<?php

include_once('./manager.php');
include_once('./Classe/Post.php');
include_once('./Classe/User.php');
include_once('./Classe/Comment.php');


$user = New User;
$user->id_user= 1;

var_dump(deletUser($user));
