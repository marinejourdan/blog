<?php

namespace App\Entity;

class User
{
    private $id = null;
    private $name = null;
    private $first_name = null;
    private $nickname = null;
    private $email = null;
    private $access = 0;
    private $password = null;
    private $enabled = 0;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setAccess(int $access)
    {
        $this->access = $access;
    }

    public function getAccess(): int
    {
        return $this->access;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setEnabled(int $enabled)
    {
        $this->enabled = $enabled;
    }

    public function getEnabled(): int
    {
        return $this->enabled;
    }

    public function hydrate(array $row)
    {
        if (null !== $row['id']) {
            $this->setId($row['id']);
        }
        $this->setName($row['name']);
        $this->setFirstName($row['first_name']);
        $this->setNickname($row['nickname']);
        $this->setEmail($row['email']);
        $this->setPassword($row['password']);
        $this->setAccess($row['access']);
        $this->setEnabled($row['enabled']);
    }
}
