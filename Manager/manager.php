<?php
// Extract data from DB

// Connect to DB and return DB resource
function dbconnect(){
    $db = new PDO('mysql:host=localhost;dbname=blog_test;charset=utf8','user','mdp');
    return $db;
}

// Extract all post from DB and return array of Post
function getPostList(): array
{
    $db = dbconnect();//nouvel objet PDO
    $sql ="SELECT * FROM post ORDER BY id DESC;";//texte
    $result=$db->query($sql);//renvoi un objet PDO Statement
    $tous_les_posts=$result->fetchAll(PDO::FETCH_ASSOC);//renvoi un tableau
    $post_object_list = array();

    foreach($tous_les_posts as $un_post_sous_forme_de_tableau){

        $id_du_post = $un_post_sous_forme_de_tableau ['id'];
        $post = getPost($id_du_post);
        $post_object_list[] = $post;//j'ajoute chaque objet post dans un tableau post object list au lieu des résultats de fetch all/
    }

    return $post_object_list;

}

 function getPost(int $id_post): Post
{
        // connexion à la bdd
        $db = dbconnect();
        //génére une requète SQL
        $sql ="SELECT id, title, header, content, updated , id_user FROM post WHERE id=$id_post ;";
        // Execute la requète (query)
        $result=$db->query($sql);
        // On met la résultat dans une variable
        $tableau_post=$result->fetch(PDO::FETCH_ASSOC);//renvoi un tableau
        //passer le tableau en objet: créer un nouvel objet, on donne des valeurs aux propriétés
        $post=New Post;
//
        $post->id = $tableau_post['id'];
        $post->title = $tableau_post['title'];
        $post->header = $tableau_post ['header'];
        $post->content = $tableau_post ['content'];
        $post->updated = $tableau_post ['updated'];
        $post->id_user= $tableau_post['id_user'];

        $user=getUser($post->id_user);
        $nickname_user = $user->nickname;
        $post->nickname_user= $nickname_user;

        //ON retroune l'objet de type post
        return $post;
}

function getUserList(): array {

    $db = dbconnect();
    $sql ="SELECT id FROM user;";
    $result=$db->query($sql);
    $tous_les_users=$result->fetchAll(PDO::FETCH_ASSOC);

    $users_object_list = array();

    foreach($tous_les_users as $un_user_sous_forme_de_tableau){
        $id_user=$un_user_sous_forme_de_tableau['id'];
        $user=getUser($id_user);
        $user_object_list[] = $user;
    }

return $user_object_list;
}

function getUser(int $id_user): User
{
    $db = dbconnect();
    $sql ="SELECT id, name, first_name, nickname, email FROM user WHERE id=$id_user ;";
    $result=$db->query($sql);
    $tableau_user=$result->fetch(PDO::FETCH_ASSOC);

    $user=New User();

    $user->id_user = $tableau_user ['id'];
    $user->name = $tableau_user ['name'];
    $user->first_name = $tableau_user ['first_name'];
    $user->nickname = $tableau_user ['nickname'];
    $user->email = $tableau_user ['email'];
    //$user->password = $tableau_user['password'];


    return $user;
}

function getCommentList(){

    $db=dbconnect();
    $sql ="SELECT * FROM comment;";
    $result=$db->query($sql);
    $tous_les_commentaires=$result->fetchAll(PDO::FETCH_ASSOC);

    $comment_object_list = array();

    foreach ($tous_les_commentaires as $un_commentaire_sous_forme_de_tableau){

        $comment=New Comment;

        $comment->id_comment = $un_commentaire_sous_forme_de_tableau ['id'];
        $comment->content = $un_commentaire_sous_forme_de_tableau ['content'];
        $comment->creation_date= $un_commentaire_sous_forme_de_tableau ['creation_date'];
        $comment->id_user = $un_commentaire_sous_forme_de_tableau['id_user'];
        $comment->id_post = $un_commentaire_sous_forme_de_tableau['id_post'];

        $user=getUser($comment->id_user);
        $nickname_user = $user->nickname;

        $comment->nickname_user= $nickname_user;

        $post=getPost($comment->id_post);

        $comment->post = $post;

        $comment_object_list[] = $comment;

    }
    return $comment_object_list;
}

function getComment(int $id_comment){

    $db=dbconnect();
    $sql ="SELECT id,content,creation_date, id_post,id_user FROM comment WHERE id=$id_comment ;";
    $result=$db->query($sql);
    $un_commentaire_sous_forme_de_tableau=$result->fetch(PDO::FETCH_ASSOC);

    $comment=New Comment;

    $comment->id_comment = $un_commentaire_sous_forme_de_tableau ['id'];
    $comment->content = $un_commentaire_sous_forme_de_tableau ['content'];
    $comment->creation_date= $un_commentaire_sous_forme_de_tableau ['creation_date'];
    $comment->id_user = $un_commentaire_sous_forme_de_tableau['id_user'];
    $comment->id_post = $un_commentaire_sous_forme_de_tableau['id_post'];

    $user=getUser($comment->id_user);
    $nickname_user = $user->nickname;
    $comment->nickname_user= $nickname_user;

    $post=getPost($comment->id_post);
    $comment->post = $post;

    $comment_object_list[] = $comment;

    return $comment;
}

function insertUser(User $user): bool
{
    $db = dbconnect();
    $sql = "INSERT INTO `user` (`name`, `first_name`, `nickname`, `email`,`password` )
                VALUES (:name, :first_name, :nickname,:email, :password);";

    $result_prepare=$db->prepare($sql);
    $result_prepare->bindValue(':name', $user->name);
    $result_prepare->bindValue(':first_name', $user->first_name);
    $result_prepare->bindValue(':nickname',$user->nickname);
    $result_prepare->bindValue(':email', $user->email);
    $result_prepare->bindValue(':password', $user->password);

    $result=$result_prepare->execute();

    if(!$result){
        var_dump($result_prepare->errorInfo());
        die('ERROR');
    }

    return $result;
}


function insertPost(Post $post): bool
{
    $db = dbconnect();
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


function insertComment(Comment $comment): bool
{
    $db = dbconnect();
    $sql =" INSERT INTO `comment` (`content`, `creation_date`, `id_post`,`id_user`)
              VALUES (:content ,:creation_date, :id_post, :id_user);";

    $result_prepare=$db->prepare($sql);
    $result_prepare->bindValue(':content', $comment->content);
    $result_prepare->bindValue(':creation_date',$comment->creation_date);
    $result_prepare->bindValue(':id_post', $comment->id_post);
    $result_prepare->bindValue(':id_user', $comment->id_user);

    $result=$result_prepare->execute();

    if(!$result){
      var_dump($result_prepare->errorInfo());
      die('ERROR');
    }

    return $result;
}



function updateUser(User $user) :bool
{
    $db = dbconnect();
    $sql = "UPDATE user SET name='$user->name', first_name='$user->first_name', nickname='$user->nickname', email='$user->email',password='$user->password'
                WHERE id=$user->id_user;";
    $result=$user->id_user;
    $result=$db->exec($sql);


    if(!$result){
        die('ERROR');
    }
    return $result;
}



function updatePost(Post $post) :bool
{
    $db = dbconnect();
    $sql = "UPDATE post SET title='$post->title', header='$post->header', content='$post->content'
                WHERE id=$post->id_post;";
    $result=$post->id_post;
    $result=$db->exec($sql);


    if(!$result){
        die('ERROR');
    }
    return $result;
}

// function updateComment(Post $post) :bool
// {
//     $db = dbconnect();
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


function deletUser(User $user): bool
{
    $db = dbconnect();
    $sql="DELETE FROM `user` WHERE id=$user->id_user";
    $result=$user->id_user;
    $result=$db->exec($sql);
    if(!$result){

        die('ERROR');
    }

    return $result;
}

function deletPost(Post $post): bool
{
    $db = dbconnect();
    $sql="DELETE FROM `post` WHERE id=$post->id_post";
    $result=$post->id_post;
    $result=$db->exec($sql);
    if(!$result){

        die('ERROR');
    }

    return $result;
}

function deletComment(Comment $comment): bool
{
    $db = dbconnect();
    $sql="DELETE FROM `comment` WHERE id=$comment->id_comment";
    $result=$comment->id_comment;
    $result=$db->exec($sql);
    if(!$result){

        die('ERROR');
    }

    return $result;
}


function getCommentsFromPost(int $id_post): array
{

    $db=dbconnect();
    $sql ="SELECT id,content,creation_date, id_post,id_user FROM comment WHERE id_post=$id_post ;";
    $result=$db->query($sql);
    $comment_list=$result->fetchAll(PDO::FETCH_ASSOC);

    $comment_object_list = array();

    foreach($comment_list as $row){

        $comment=getComment($row['id']);

        $comment_object_list[] = $comment;
    }
    return $comment_object_list;
}
