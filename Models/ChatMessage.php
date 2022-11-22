<?php

namespace Models;

class ChatMessage {
    private $id;
    private $idSender;
    private $message;
    private $date;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIdSender()
    {
        return $this->idSender;
    }

    public function setIdSender($idSender): void
    {
        $this->idSender = $idSender;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message): void
    {
        $this->message = $message;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

}