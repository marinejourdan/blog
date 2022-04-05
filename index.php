<?php

include_once('./manager.php');
include_once('./Classe/Post.php');
include_once('./Classe/User.php');
include_once('./Classe/Comment.php');


$id_user=3;
$user=getUser($id_user);
var_dump($user);

$user->name='bob';
var_dump($user);

$resultat=updateUser($user);
var_dump($resultat);
