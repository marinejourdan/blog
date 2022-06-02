<?php
namespace App\Manager;

use App\Entity\Post;
use App\Entity\Comment;
use App\Manager\UserManager;


class PostManager extends BaseManager{

    const SQL_GET_LIST= <<<'SQL'
    SELECT id
    FROM post
    ORDER BY id DESC
    SQL;

    const SQL_GET= <<<'SQL'
    SELECT id, title, header, content, updated , id_user
    FROM post
    WHERE id=:id ;
    SQL;

    public function lastPosts(int $last=3): array
    {
        $db=$this->dbconnect();
        $sql ="SELECT * FROM post ORDER BY updated DESC LIMIT :limit";
        $sql=\str_replace(':limit',$last, $sql);
        $statement=$db->prepare($sql);
        $statement->execute();
        $tous_les_posts=$statement->fetchAll(\PDO::FETCH_ASSOC);
        $post_object_list = array();
        foreach($tous_les_posts as $row){

            $post=$this->createObject($row);
            $post_object_list[] = $post;//j'ajoute chaque objet post dans un tableau post object list au lieu des résultats de fetch all/
        }
        return $post_object_list;
    }

    public function createObject(array $row=[]): Post
    {

        $post=new Post;
        $post->hydrate($row);
        $userManager= New UserManager;
        $id=$post->getIdUser();
        $user=$userManager->get($post->getIdUser());
        $nickname_user = $user->getNickname();
        $post->setNicknameUser($nickname_user);
        return $post;
    }

    const SQL_INSERT = <<<'SQL'
    INSERT INTO `post` (`title`, `header`, `content`, `updated`,`id_user`)
    VALUES ( :title ,:header, :content,:updated, :id_user);
    SQL;

    const SQL_UPDATE = <<<'SQL'
    UPDATE post
    SET title=:title, header=:header,
    content=:content, updated= :updated, id_user= :id_user
    WHERE id=:id;
    SQL;


    public function bindValues($statement, Post $post)
    {
       $statement->bindValue(':id', $post->getId());
       $statement->bindValue(':title', $post->getTitle());
       $statement->bindValue(':header', $post->getHeader());
       $statement->bindValue(':content',$post->getContent());
       $statement->bindValue(':updated', $post->getUpdated());
       $statement->bindValue(':id_user', $post->getIdUser());

       return $statement;
    }

    const SQL_DELETE = <<<'SQL'
    DELETE FROM `post`
    WHERE id=:id;
    SQL;
}
