<?php
namespace App\Manager;

use App\Entity\Post;
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

        foreach($tous_les_posts as $un_post_sous_forme_de_tableau){
            $id_post=$un_post_sous_forme_de_tableau['id'];
            $post=$this->get($id_post);
            $post_object_list[] = $post;//j'ajoute chaque objet post dans un tableau post object list au lieu des résultats de fetch all/
        }
        return $post_object_list;
    }

    public function create(array $row=[]): post{

        $post=New Post;

        $post->id = $row['id'];
        $post->title = $row['title'];
        $post->header = $row ['header'];
        $post->content = $row ['content'];
        $post->updated = $row ['updated'];
        $post->id_user= $row['id_user'];

        $userManager= New UserManager;
        $id=$post->id_user;

        $user=$userManager->get($post->id_user);
        $nickname_user = $user->nickname;
        $post->nickname_user= $nickname_user;

        return $post;

    }

    const SQL_INSERT = <<<'SQL'
    INSERT INTO `post` (`title`, `header`, `content`, `updated`,`id_user`)
    VALUES (:title ,:header, :content,:updated, :id_user);
    SQL;

    public function insert(Post $post): bool
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_INSERT);
        $statement->bindValue(':title', $post->title);
        $statement->bindValue(':header', $post->header);
        $statement->bindValue(':content',$post->content);
        $statement->bindValue(':updated', $post->updated);
        $statement->bindValue(':id_user', $post->id_user);

        $result=$statement->execute();
       return $result;
    }

    const SQL_UPDATE = <<<'SQL'
    UPDATE post
    SET title=:title, header=:header,
    content=:content, updated= :updated, id_user= :id_user
    WHERE id=:id;
    SQL;


    public function bindValues($statement, Post $object)
    {
       $statement->bindValue(':id', $post->id);
       $statement->bindValue(':title', $post->title);
       $statement->bindValue(':header', $post->header);
       $statement->bindValue(':content',$post->content);
       $statement->bindValue(':updated', $post->updated);
       $statement->bindValue(':id_user', $post->id_user);

       return $statement;
    }

    const SQL_DELETE = <<<'SQL'
    DELETE FROM `post`
    WHERE id=:id;
    SQL;

}
