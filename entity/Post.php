<?php
namespace App\Entity;

class Post{

    public  $id = NULL;
    public  $title = NULL;
    public  $header = NULL;
    public  $content = NULL;
    public  $updated = NULL;
    public  $id_user = NULL;
    public  $comment_list =NULL;
    public  $nickname_user= NULL;


//
//
//     function update_post(){
//         $db = new PDO('mysql:host=localhost;dbname=blog_test;charset=utf8','user','mdp');
//         if (empty($this->titre) || empty($this->chapo)|| empty($this->contenu)){
//             return false;
//         }
//         $sql="UPDATE post SET titre='$this->titre', chapo='$this->chapo', contenu= '$this->contenu'
//             WHERE id=$this->id;";
//
//         $result=$db->exec($sql);
//         if ($result==true){
//             return true;
//         }
//     }
//
//
// function insert_post(){
//
//     if (empty($titre) || empty($chapo) || empty($contenu)) {
//     		return false;
//     }else{
//         $sql=" INSERT INTO `post` (`titre`, `chapo`, `contenu`, `date_maj`,`id_user`)
//                   VALUES (:titre,:chapo, :conenu,:date_maj, :id_user);";
//         echo $sql .'</br>';
//         $result_prepare=$db->prepare($sql);
//         $result_prepare ->bindValue (':titre',$titre);
//         $result_prepare ->bindValue (':chapo',$chapo);
//         $result_prepare ->bindValue (':contenu',$contenu);
//         $result_prepare ->bindValue (':date_maj',$date_maj);
//         $result_prepare ->bindValue (':date_maj',$id_user);
//         $result=$result_prepare->exec();
//         var_dump($result);
//     }
}

// ?>
