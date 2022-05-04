<?php
namespace App\Manager;

use App\Entity\Comment;
use App\Manager\PostManager;
use App\Manager\UserManager;


class CommentManager extends BaseManager{

    private $postManager;
    private $userManager;

    public function __construct(PostManager $postManager, UserManager $userManager){
       $this->userManager=$userManager;
       $this->postManager=$postManager;
   }

    public function getCommentList(){

        $db=$this->dbconnect();
        $sql ="SELECT * FROM comment;";
        $result=$db->query($sql);
        $tous_les_commentaires=$result->fetchAll(\PDO::FETCH_ASSOC);

        $comment_object_list = array();

        foreach ($tous_les_commentaires as $un_commentaire_sous_forme_de_tableau){
            $comment=$this->getComment($comment->id_comment);
            $comment_object_list[] = $comment;
        }
        return $comment_object_list;
    }

    public function getComment(int $id_comment){

        $db=$this->dbconnect();

        $sql ="SELECT id, content, creation_date, id_post, id_user FROM comment WHERE id=:id_comment;";
        $statement=$db->prepare($sql);
        $statement->bindValue(':id_comment', $id_comment);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if(!$result){
          var_dump($result_prepare->errorInfo());
          die('ERROR');
        }

        $comment=New Comment;
        $comment->id=$result['id'];
        $comment->content=$result['content'];
        $comment->creation_date=$result['creation_date'];
        $comment->id_post=$result['id_post'];
        $comment->id_user=$result['id_user'];

        $user=$this->userManager->getUser($comment->id_user);


        $nickname_user = $user->nickname;
        $comment->nickname_user= $nickname_user;

        $post=$this->postManager->getPost($comment->id_post);
        $comment->post = $post;

        $comment_object_list[] = $comment;

        return $comment;
    }



    public function insertComment($comment): bool
    {
        $db=$this->dbconnect();
        $sql =" INSERT INTO `comment` (`content`, `creation_date`, `id_post`,`id_user`)
                  VALUES (:content ,:creation_date, :id_post, :id_user);";

        $statement=$db->prepare($sql);
        $statement->bindValue(':content', $comment->content);
        $statement->bindValue(':creation_date',$comment->creation_date);
        $statement->bindValue(':id_post', $comment->id_post);;
        $statement->bindValue(':id_user', $comment->id_user);

        $result=$statement->execute();

        if(!$result){
          var_dump($statement->errorInfo());
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
        //var_dump($comment_list);
        foreach($comment_list as $row){

           $comment=$this->getComment($row['id']);

           $comment_object_list[] = $comment;
        }
        return $comment_object_list;
    }
}
