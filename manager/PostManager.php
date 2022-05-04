<?php
namespace App\Manager;

use App\Entity\Post;
use App\Manager\UserManager;


class PostManager extends BaseManager{

    // Extract all post from DB and return array of Post
    public function getPostList(): array
    {
        $db=$this->dbconnect();//nouvel objet PDO
        $sql ="SELECT * FROM post ORDER BY id DESC;";//texte
        $result=$db->query($sql);//renvoi un objet PDO Statement
        $tous_les_posts=$result->fetchAll(\PDO::FETCH_ASSOC);//renvoi un tableau
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
        $result=$db->query($sql);//renvoi un objet PDO Statement
        $tous_les_posts=$result->fetchAll(\PDO::FETCH_ASSOC);//renvoi un tableau
        $post_object_list = array();

        foreach($tous_les_posts as $un_post_sous_forme_de_tableau){
            $id_post=$un_post_sous_forme_de_tableau['id'];
            $post=$this->getPost($id_post);
            $post_object_list[] = $post;//j'ajoute chaque objet post dans un tableau post object list au lieu des résultats de fetch all/
        }
        return $post_object_list;
    }

    public function getPost($id_post): Post
    {
           // connexion à la bdd
           $db=$this->dbconnect();
           //génére une requète SQL
           $sql ="SELECT id, title, header, content, updated , id_user FROM post WHERE id=$id_post ;";
           $statement=$db->prepare($sql);
           $statement->bindValue(':id_post', $id_post);
           $statement->execute();
           $result = $statement->fetch(\PDO::FETCH_ASSOC);
          //renvoi un tableau
            //}catch(\Throwable $e){
            //var_dump ($db->errorInfo());
            //}

           //passer le tableau en objet: créer un nouvel objet, on donne des valeurs aux propriétés
           $post=New Post;

           $post->id = $result['id'];
           $post->title = $result['title'];
           $post->header = $result ['header'];
           $post->content = $result ['content'];
           $post->updated = $result ['updated'];
           $post->id_user= $result['id_user'];


           $userManager= New UserManager;
           $user=$userManager->getUser($post->id_user);
           $nickname_user = $user->nickname;
           $post->nickname_user= $nickname_user;

           //ON retroune l'objet de type post
           return $post;
    }



    public function insertPost(Post $post): bool
    {
        $db=$this->dbconnect();
        $sql =" INSERT INTO `post` (`title`, `header`, `content`, `updated`,`id_user`)
                 VALUES (:title ,:header, :content,:updated, :id_user);";

        $statement=$db->prepare($sql);
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



    public function updatePost(Post $post) :bool
    {
       $db=$this->dbconnect();
       $sql = "UPDATE post SET title='$post->title', header='$post->header', content='$post->content'
                   WHERE id=$post->id_post;";
       $result=$post->id_post;
       $result=$db->exec($sql);


       if(!$result){
           die('ERROR');
       }
       return $result;
    }



    public function deletPost(Post $post): bool
    {
        $db=$this->dbconnect();
        $sql="DELETE FROM post WHERE id=$post->id_post";
        $result=$post->id_post;
        $result=$db->exec($sql);
        if(!$result){

           die('ERROR');
       }

       return $result;
    }
}
