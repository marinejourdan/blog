<?php

namespace App\Entity;

class Post
{
    private $id = null;
    private $title = null;
    private $header = null;
    private $content = null;
    private $updated = null;
    private $id_user = null;
    private $comment_list = null;
    private $nickname_user = null;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setHeader(string $header)
    {
        $this->header = $header;
    }

    public function getHeader(): string
    {
        return $this->header;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setUpdated(string $updated)
    {
        $this->updated = $updated;
    }

    public function getUpdated(): string
    {
        return $this->updated;
    }

    public function getCommentList(): array
    {
        return $this->comment_list;
    }

    public function setCommentList(array $comment_list)
    {
        $this->comment_list = $comment_list;
    }

    public function setNicknameUser(string $nickname_user)
    {
        $this->nickname_user = $nickname_user;
    }

    public function getNicknameUser(): string
    {
        return $this->nickname_user;
    }

    public function setIdUser(int $id_user)
    {
        $this->id_user = $id_user;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function hydrate(array $row)
    {
        if (null !== $row['id']) {
            $this->setId($row['id']);
        }

        $this->setTitle($row['title']);
        $this->setHeader($row['header']);
        $this->setContent($row['content']);
        $this->setUpdated($row['updated']);
        $this->setIdUser($row['id_user']);
    }
}
