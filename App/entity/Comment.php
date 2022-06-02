<?php
namespace App\Entity;

class Comment{

    private $id = NULL;
    private $content = NULL;
    private $creation_date= NULL;
    private $id_post = NULL;
    private $id_user = NULL;
    private $nickname_user= NULL;
    private $post=NULL;
    private $publication=0;


    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }


    public function setIdPost(int $id_post)
    {
        $this->id_post = $id_post;
    }

    public function getIdPost(): int
    {
        return $this->id_post;
    }


    public function setCreationDate(string $creation_date)
    {
        $this->creation_date = $creation_date;
    }

    public function getCreationDate(): string
    {
        return $this->creation_date;
    }

    public function setIdUser(int $id_user)
    {
        $this->id_user = $id_user;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function setPublication(int $publication)
    {
        $this->publication = $publication;
    }

    public function getPublication(): int
    {
        return $this->publication;
    }

    public function setNicknameUser(string $nickname_user)
    {
        $this->nickname_user = $nickname_user;
    }

    public function getNicknameUser(): string
    {
        return $this->nickname_user;
    }

    public function setPost(string $post)
    {
        $this->post = $post;
    }

    public function getPost(): string
    {
        return $this->post;
    }

    public function hydrate(array $row){

        $this->setId($row['id']);
        $this->setContent($row['content']);
        $this->setCreationDate($row['creation_date']);
        $this->setIdPost($row['id_post']);
        $this->setIdUser($row['id_user']);
        $this->setPublication($row['publication']);
    }

}
