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


    const SQL_GET_LIST= <<<'SQL'
    SELECT *
    FROM comment
    SQL;

    const SQL_GET = <<<'SQL'
    SELECT id, content, creation_date, id_post, id_user
    FROM comment
    WHERE id=:id;
    SQL;

    public function create(array $row=[]): Comment{

        $comment=New Comment;

        $comment->id=$row['id'];
        $comment->content=$row['content'];
        $comment->creation_date=$row['creation_date'];
        $comment->id_post=$row['id_post'];
        $comment->id_user=$row['id_user'];

        $user=$this->userManager->get($comment->id_user);
        $nickname_user = $user->nickname;
        $comment->nickname_user= $nickname_user;

        $post=$this->postManager->get($comment->id_post);
        $post= $post->content;
        $comment->post= $post;

        return $comment;

    }


    const SQL_INSERT = <<<'SQL'
    INSERT INTO `comment` (`content`, `creation_date`, `id_post`,`id_user`)
    VALUES (:content ,:creation_date, :id_post, :id_user);
    SQL;

    public function insert($comment): bool
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_INSERT);
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


    const SQL_DELETE= <<<'SQL'
    DELETE FROM `comment`
    WHERE id=:id;
    SQL;

    public function delete(Comment $comment): bool
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_DELETE);
        $statement->bindValue(':id', $comment->id);
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
