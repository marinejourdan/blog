<?php

include_once('./manager.php');
include_once('./Classe/Post.php');
include_once('./Classe/User.php');
include_once('./Classe/Comment.php');


$comment = New Comment;
$comment->id_comment= 3;

var_dump(deletComment($comment));
