<?php

    namespace Controllers;

    use DAO\ChatDAO;
    use Models\Chat;
    use Models\Status;
    use Controllers\KeeperController;
    use Controllers\ChatMessageController;

    class ChatController {

        public $chatDAO;
        private $chatMessageController;

        public function __construct() {
            $this->chatDAO = new ChatDAO();
            $this->keeperController = new KeeperController();
            $this->chatMessageController = new ChatMessageController();
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
                $this->chatDAO->modifyStatus($chatId, $status);
            
            if($status==1) $this->showListView("Chat Accepted");
            else $this->showListView("Chat Rejected");
        }

        public function showListView($message="") {
            require_once(VIEWS_PATH."validate-session.php");

            $chatList = array();
            $logged = $_SESSION["loggedUser"];

            if($logged->getUserType()->getNameType() == "Owner") {
                $chatList = $this->chatDAO->getChatsForOwner($logged->getId());
                require_once(VIEWS_PATH."chat-list-owner.php");
            } else {
                $chatList = $this->chatDAO->getChatsForKeeper($logged->getId());
                require_once(VIEWS_PATH."chat-list-keeper.php");
            }
        }
        public function chatView($idChat, $name)
        {
            require_once(VIEWS_PATH."validate-session.php");

            $messageList = array();
            $logged = $_SESSION["loggedUser"];

            if($logged->getUserType()->getNameType() == "Owner") 
            {
                $messageList = $this->chatMessageController()->getListByChatId($idChat);

            } 
            else 
            {

                
            }
            require_once(VIEWS_PATH."chat-view.php");
        }

    }