<?php

    namespace Controllers;

    use DAO\ChatDAO;
    use Models\Chat;

    class ChatController {

        public $chatDAO;

        public function __construct() {
            $this->chatDAO = new ChatDAO();
        }

        public function add($idUserKeeper) {
            $chat = new Chat();

            $chat->setIdUserOwner($_SESSION["loggedUser"]->getId());
            $chat->setIdUserKeeper($idUserKeeper);
            $chat->setStatus(true);  // siempre al momento de generar un nuevo chat por default este está activo

            $this->chatDAO->add($chat);
        }

    }