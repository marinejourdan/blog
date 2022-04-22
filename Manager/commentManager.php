<?php

function getCommentList(){

    $db=dbconnect();
    $sql ="SELECT * FROM comment;";
    $result=$db->query($sql);
    $tous_les_commentaires=$result->fetchAll(PDO::FETCH_ASSOC);

    $comment_object_list = array();

    foreach ($tous_les_commentaires as $un_commentaire_sous_forme_de_tableau){

        $comment=New Comment;

        $comment->id_comment = $un_commentaire_sous_forme_de_tableau ['id'];
        $comment->content = $un_commentaire_sous_forme_de_tableau ['content'];
        $comment->creation_date= $un_commentaire_sous_forme_de_tableau ['creation_date'];
        $comment->id_user = $un_commentaire_sous_forme_de_tableau['id_user'];
        $comment->id_post = $un_commentaire_sous_forme_de_tableau['id_post'];

        $user=getUser($comment->id_user);
        $nickname_user = $user->nickname;

        $comment->nickname_user= $nickname_user;

        $post=getPost($comment->id_post);

        $comment->post = $post;

        $comment_object_list[] = $comment;

    }
    return $comment_object_list;
}

function getComment(int $id_comment){

    $db=dbconnect();
    $sql ="SELECT id,content,creation_date, id_post,id_user FROM comment WHERE id=$id_comment ;";
    $result_prepare=$db->query($sql);

    $comment=New Comment;

    $result_prepare=$db->prepare($sql);
    $result_prepare->bindValue(':content', $comment->content);
    $result_prepare->bindValue(':creation_date',$comment->creation_date);
    $result_prepare->bindValue(':id_post', $comment->id_post);
    $result_prepare->bindValue(':id_user', $comment->id_user);

    $result=$result_prepare->execute();

    $user=getUser($comment->id_user);
    $nickname_user = $user->nickname;
    $comment->nickname_user= $nickname_user;

    $post=getPost($comment->id_post);
    $comment->post = $post;

    $comment_object_list[] = $comment;

    return $comment;
}

function getCommentFromPost(int $id_post){
$db=dbconnect();

$sql ="SELECT id,content,creation_date, id_post,id_user FROM comment WHERE id=$id_post ;";
$result_prepare=$db->query($sql);

$comment=New Comment;

$result_prepare=$db->prepare($sql);
$result_prepare->bindValue(':content', $comment->content);
$result_prepare->bindValue(':creation_date',$comment->creation_date);
$result_prepare->bindValue(':id_post', $comment->id);
$result_prepare->bindValue(':id_user', $comment->id_user);
$result=$result_prepare->execute();

$comment_object_list[] = $comment;

return $comment;
}

function insertComment(Comment $comment): bool
{
    $db = dbconnect();
    $sql =" INSERT INTO `comment` (`content`, `creation_date`, `id_post`,`id_user`)
              VALUES (:content ,:creation_date, :id_post, :id_user);";

    $result_prepare=$db->prepare($sql);
    $result_prepare->bindValue(':content', $comment->content);
    $result_prepare->bindValue(':creation_date',$comment->creation_date);
    $result_prepare->bindValue(':id_post', $comment->id_post);
    $result_prepare->bindValue(':id_user', $comment->id_user);

    $result=$result_prepare->execute();

    if(!$result){
      var_dump($result_prepare->errorInfo());
      die('ERROR');
    }

    return $result;
}


function deletComment(Comment $comment): bool
{
    $db = dbconnect();
    $sql="DELETE FROM `comment` WHERE id=$comment->id_comment";
    $result=$comment->id_comment;
    $result=$db->exec($sql);
    if(!$result){

        die('ERROR');
    }

    return $result;
}
