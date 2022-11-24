<?php

    namespace Controllers;

    use DAO\ChatDAO;
    use Models\Chat;
    use Models\Status;
    use Controllers\KeeperController;

    class ChatController {

        public $chatDAO;

        public function __construct() {
            $this->chatDAO = new ChatDAO();
            $this->keeperController = new KeeperController();
        }

        public function add($idUserKeeper) {
            require_once(VIEWS_PATH."validate-session.php");

            $chat = new Chat();

            $chat->setIdUserOwner($_SESSION["loggedUser"]->getId());
            $chat->setIdUserKeeper($idUserKeeper);
            $chat->setStatus(Status::Pending);

            $this->chatDAO->add($chat);
            $this->keeperController->showListView("Chat creado, esperando confirmacion");
        }

        public function modifyStatus($chatId, $status) {
            require_once(VIEWS_PATH."validate-session.php");
            $chat = $this->chatDAO->getById($chatId);
            
            if($chat)
            {       
                $chat->setStatus($status); 
            }
        }

        public function showChatsView() {
            require_once(VIEWS_PATH."validate-session.php");
            $chatList = array();

            /*
            if(keeper) {
                chatList=chatDAO->getChatsForKeeper (crear metodo en chatDAO y procedure correspondiente)
            }
            else {
                chatList=chatDAO->getChatsForOwner (crear metodo en chatDAO y procedure correspondiente)
            }

            require once chatView (esto sería para compartir una chat view, CREAR CHAT VIEW)
            */

            $logged = $_SESSION["loggedUser"];

            if($logged->getUserType()->getNameType() == "Owner") {
                $chatList = $this->chatDAO->getChatsForOwner($logged->getId());
                require_once(VIEWS_PATH."chat-list-owner");
            } else {
                $chatList = $this->chatDAO->getChatsForKeeper($logged->getId());
                require_once(VIEWS_PATH."chat-list-keeper");
            }
        }

    }