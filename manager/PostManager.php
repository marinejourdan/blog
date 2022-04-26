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

            $id_du_post = $un_post_sous_forme_de_tableau ['id'];
            $postManager = New PostManager;
            $post=$postManager->getPost($id_du_post);
            $post_object_list[] = $post;//j'ajoute chaque objet post dans un tableau post object list au lieu des résultats de fetch all/
        }

        return $post_object_list;
    }


    public function getPost(int $id_post): Post
    {
           // connexion à la bdd
           $db=$this->dbconnect();
           //génére une requète SQL
           $sql ="SELECT id, title, header, content, updated , id_user FROM post WHERE id=$id_post ;";
           // Execute la requète (query)
           $result=$db->query($sql);
           // On met la résultat dans une variable
           $tableau_post=$result->fetch(\PDO::FETCH_ASSOC);//renvoi un tableau
           //passer le tableau en objet: créer un nouvel objet, on donne des valeurs aux propriétés
           $post=New Post;
    //
           $post->id = $tableau_post['id'];
           $post->title = $tableau_post['title'];
           $post->header = $tableau_post ['header'];
           $post->content = $tableau_post ['content'];
           $post->updated = $tableau_post ['updated'];
           $post->id_user= $tableau_post['id_user'];


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

        $result_prepare=$db->prepare($sql);
        $result_prepare->bindValue(':title', $post->title);
        $result_prepare->bindValue(':header', $post->header);
        $result_prepare->bindValue(':content',$post->content);
        $result_prepare->bindValue(':updated', $post->updated);
        $result_prepare->bindValue(':id_user', $post->id_user);

        $result=$result_prepare->execute();

        if(!$result){
         var_dump($result_prepare->errorInfo());
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
        $sql="DELETE FROM `post` WHERE id=$post->id_post";
        $result=$post->id_post;
        $result=$db->exec($sql);
        if(!$result){

           die('ERROR');
       }

       return $result;
    }
}
