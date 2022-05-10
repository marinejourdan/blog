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


    const SQL_GET_COMMENT_LIST= <<<'SQL'
    SELECT *
    FROM comment
    SQL;
    public function getCommentList():array
    {

    $db=$this->dbconnect();
    $statement=$db->prepare(self::SQL_GET_COMMENT_LIST);
    $statement->execute();
    $tous_les_commentaires = $statement->fetchAll(\PDO::FETCH_ASSOC);
    $comment_object_list = array();

    foreach ($tous_les_commentaires as $un_commentaire_sous_forme_de_tableau){
        $id=$un_commentaire_sous_forme_de_tableau['id'];
        $comment=$this->getComment($id);
        $comment_object_list[] = $comment;
    }
    return $comment_object_list;
    }


    const SQL_GET_COMMENT = <<<'SQL'
    SELECT id, content, creation_date, id_post, id_user
    FROM comment
    WHERE id=:id;
    SQL;

    public function getComment(int $id) :comment{

        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_GET_COMMENT);
        $statement->bindValue(':id', $id);
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
        $post= $post->content;
        $comment->post= $post;

        return $comment;

    }


    const SQL_INSERT_COMMENT = <<<'SQL'
    INSERT INTO `comment` (`content`, `creation_date`, `id_post`,`id_user`)
    VALUES (:content ,:creation_date, :id_post, :id_user);
    SQL;

    public function insertComment($comment): bool
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_INSERT_COMMENT);
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


    const SQL_DELET_COMMENT = <<<'SQL'
    DELETE FROM `comment`
    WHERE id=:id;
    SQL;

    public function deletComment(Comment $comment): bool
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_DELET_COMMENT);
        $statement->bindValue(':id', $comment->id);;
        $result=$statement->execute();
        $id=$comment->id;

        if(!$result){

            die('ERROR');
        }

        return $result;

    }

    const SQL_GET_COMMENT_FROM_POST = <<<'SQL'
    SELECT id,content,creation_date, id_post,id_user
    FROM comment WHERE id_post=$id_post;
    SQL;

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
