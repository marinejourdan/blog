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
    SELECT id
    FROM comment
    SQL;

    const SQL_GET = <<<'SQL'
    SELECT id, content, creation_date, id_post, id_user,publication
    FROM comment
    WHERE id=:id;
    SQL;

    public function createObject(array $row=[]): Comment
    {
        $comment=New Comment;
        $comment->hydrate($row);

        $user=$this->userManager->get($comment->getIdUser());
        $nickname_user = $user->getNickname();
        $comment->setNicknameUser($nickname_user);
        $post=$this->postManager->get($comment->getIdPost());
        $post= $post->getContent();
        $comment->setPost($post);

        return $comment;
    }


    const SQL_INSERT = <<<'SQL'
    INSERT INTO `comment` (`content`, `creation_date`, `id_post`,`id_user`,'publication') VALUES (:content , :creation_date, :id_post, :id_user,:publication);
    SQL;

    public function bindValues($statement, Comment $comment)
    {
        $statement->bindValue(':content', $comment->getContent());
        $statement->bindValue(':creation_date',$comment-> getCreationDate());
        $statement->bindValue(':id_post', $comment->getIdPost());
        $statement->bindValue(':id_user', $comment->getIdUser());
        $statement->bindValue(':publication', $comment->getPublication());

        return $statement;
    }
    const SQL_DELETE  = <<<'SQL'
    DELETE FROM comment
    WHERE id=:id;
    SQL;

    const SQL_UPDATE= <<<'SQL'
    UPDATE comment SET
    publication=:publication
    WHERE id=:id;
    SQL;

    public function publishComment($comment) :bool
    {
       $db=$this->dbconnect();
       $statement=$db->prepare(static::SQL_UPDATE);
       $statement->bindValue(':publication', $comment->getPublication());
       $statement->bindValue(':id', $comment->getId());
       $result=$statement->execute();

       return $result;
    }

    const SQL_GET_PUBLISHED_COMMENTS_FROM_POST = <<<'SQL'
    SELECT id,content,creation_date, id_post,id_user, publication
    FROM comment WHERE id_post=:id_post AND publication=1;
    SQL;

    public function getPublishedCommentsFromPost(int $id_post): array
    {

        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_GET_PUBLISHED_COMMENTS_FROM_POST);
        $statement->bindValue(':id_post',$id_post);
        $statement->execute();
        $data_list=$statement->fetchAll(\PDO::FETCH_ASSOC);

        $object_list = array();

        foreach($data_list as $row){
            $object=$this->createObject($row);
            $object_list[] = $object;
        }
        return $object_list;
    }

}
