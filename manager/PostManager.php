<?php
namespace App\Manager;

use App\Entity\Post;
use App\Manager\UserManager;


class PostManager extends BaseManager{




    const SQL_GET_POST_LIST= <<<'SQL'
    SELECT *
    FROM post
    ORDER BY id DESC
    SQL;

    public function getList(): array
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_GET_POST_LIST);
        $statement->execute();
        $tous_les_posts=$statement->fetchAll(\PDO::FETCH_ASSOC);
        $post_object_list = array();

        foreach($tous_les_posts as $un_post_sous_forme_de_tableau){
            $id_du_post=$un_post_sous_forme_de_tableau['id'];
            $post=$this->getPost($id_du_post);
            $post_object_list[] = $post;//j'ajoute chaque objet post dans un tableau post object list au lieu des résultats de fetch all/
        }

        return $post_object_list;
    }




    public function lastPosts(int $last=3): array
    {
        $db=$this->dbconnect();
        $sql ="SELECT * FROM post ORDER BY updated DESC LIMIT ".$last.";";
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

    const SQL_GET_POST= <<<'SQL'
    SELECT id, title, header, content, updated , id_user
    FROM post
    WHERE id=:id_post ;
    SQL;


    public function get($id_post): Post
    {
           $db=$this->dbconnect();
           $statement=$db->prepare(self::SQL_GET_POST);
           $statement->bindValue(':id_post', $id_post);
           $statement->execute();
           $result = $statement->fetch(\PDO::FETCH_ASSOC);


           $post=New Post;

           $post->id = $result['id'];
           $post->title = $result['title'];
           $post->header = $result ['header'];
           $post->content = $result ['content'];
           $post->updated = $result ['updated'];
           $post->id_user= $result['id_user'];



           $userManager= New UserManager;
           $id=$post->id_user;
           $user=$userManager->get($post->id_user);
           $nickname_user = $user->nickname;
           $post->nickname_user= $nickname_user;

           return $post;
    }


    const SQL_INSERT_POST = <<<'SQL'
    INSERT INTO `post` (`title`, `header`, `content`, `updated`,`id_user`)
    VALUES (:title ,:header, :content,:updated, :id_user);
    SQL;

    public function insert(Post $post): bool
    {
        var_dump($post);
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_INSERT_POST);
        $statement->bindValue(':title', $post->title);
        $statement->bindValue(':header', $post->header);
        $statement->bindValue(':content',$post->content);
        $statement->bindValue(':updated', $post->updated);
        $statement->bindValue(':id_user', $post->id_user);

        $result=$statement->execute();

        if(!$result){
         var_dump($statement->errorInfo());
         die('ERROR');
        }

       return $result;
    }

    const SQL_UPDATE_COMMENT = <<<'SQL'
    UPDATE post
    SET title=:title, header=:header,
    content=:content, updated= :updated, id_user= :id_user
    WHERE id=:id;
    SQL;


    public function update(Post $post) :bool
    {
       $db=$this->dbconnect();
       $statement=$db->prepare(self::SQL_UPDATE_COMMENT);
       $statement->bindValue(':id', $post->id);
       $statement->bindValue(':title', $post->title);
       $statement->bindValue(':header', $post->header);
       $statement->bindValue(':content',$post->content);
       $statement->bindValue(':updated', $post->updated);
       $statement->bindValue(':id_user', $post->id_user);

       $result=$statement->execute();

       if(!$result){
            var_dump($statement->errorInfo());
           die('ERROR');
       }
       return $result;
    }

    const SQL_DELET_POST = <<<'SQL'
    DELETE FROM `post`
    WHERE id=:id;
    SQL;

    public function delete(Post $post): bool
    {
        $db=$this->dbconnect();
        $statement=$db->prepare(self::SQL_DELET_POST);
        $statement->bindValue(':id', $post->id);
        $result=$statement->execute();
        $id=$post->id;

        if(!$result){

           die('ERROR');
       }

       return $result;
    }
}
