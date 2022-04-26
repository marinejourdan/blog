<?php
namespace App\Manager;

use App\Entity\Comment;

class CommentManager extends BaseManager{


    public function getCommentList(){

        $db=$this->dbconnect();
        $sql ="SELECT * FROM comment;";
        $result=$db->query($sql);
        $tous_les_commentaires=$result->fetchAll(\PDO::FETCH_ASSOC);

        $comment_object_list = array();

        foreach ($tous_les_commentaires as $un_commentaire_sous_forme_de_tableau){

            $comment=$this->getComment($un_commentaire_sous_forme_de_tableau ['id']);

            $comment_object_list[] = $comment;

        }
        return $comment_object_list;
    }

    public function getComment(int $id_comment){

        $db=$this->dbconnect();
        $sql ="SELECT id,content,creation_date, id_post,id_user FROM comment WHERE id=$id_comment ;";
        $result=$db->query($sql);
        $tableau_commentaire=$result->fetch(\PDO::FETCH_ASSOC);

        $comment=New Comment;

        $comment->id_comment = $tableau_commentaire ['id'];
        $comment->content = $tableau_commentaire ['content'];
        $comment->creation_date= $tableau_commentaire ['creation_date'];
        $comment->id_user = $tableau_commentaire['id_user'];
        $comment->id_post = $tableau_commentaire['id_post'];

        $userManager = New UserManager();
        $user=$userManager->getUser($comment->id_user);

        $nickname_user = $user->nickname;
        $comment->nickname_user= $nickname_user;

        $PostManager = New PostManager();
        $post=$PostManager->getPost($comment->id_post);
        $comment->post = $post;

        $comment_object_list[] = $comment;

        return $comment;
    }



    public function insertComment(Comment $comment): bool
    {
        $db=$this->dbconnect();
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


    // function updateComment(Post $post) :bool
    // {
    //     $db=$this->dbconnect();
    //     $sql = "UPDATE comment SET content='$comment->content', header='$post->header', content='$post->content'
    //                 WHERE id=$post->id_post;";
    //     $result=$post->id_post;
    //     $result=$db->exec($sql);

        //
        // if(!$result){
        //     die('ERROR');
        // }
        // return $result;
        //


    public function deletComment(Comment $comment): bool
    {
        $db=$this->dbconnect();
        $sql="DELETE FROM `comment` WHERE id=$comment->id_comment";
        $result=$comment->id_comment;
        $result=$db->exec($sql);
        if(!$result){

            die('ERROR');
        }

        return $result;

    }
    public function getCommentsFromPost(int $id_post): array
    {

    $db=$this->dbconnect();
    $sql ="SELECT id,content,creation_date, id_post,id_user FROM comment WHERE id_post=$id_post ;";
    $result=$db->query($sql);
    $comment_list=$result->fetchAll(\PDO::FETCH_ASSOC);

    $comment_object_list = array();

    foreach($comment_list as $row){

       $comment=getComment($row['id']);

       $comment_object_list[] = $comment;
    }
    return $comment_object_list;
    }
}
