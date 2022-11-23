<?php

namespace Models;

class Chat {
    private $id;
    private $idUserOwner;
    private $idUserKeeper;
    private $status;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIdUserOwner()
    {
        return $this->idUserOwner;
    }

    public function setIdUserOwner($idUserOwner): void
    {
        $this->idUserOwner = $idUserOwner;
    }

    public function getIdUserKeeper()
    {
        return $this->idUserKeeper;
    }

    public function setIdUserKeeper($idUserKeeper): void
    {
        $this->idUserKeeper = $idUserKeeper;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }


}