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
        public function modify()
        {
            require_once(VIEWS_PATH."validate-session.php");

        }
        public function showChatView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            /*
            if(keeper)
            {
                chatList=chatDAO->getChatsForKeeper (crear metodo en chatDAO y procedure correspondiente)
            }
            else
            {
                chatList=chatDAO->getChatsForKeeper (crear metodo en chatDAO y procedure correspondiente)
            }
            require once chatView (esto sería para compartir una chat view, CREAR CHAT VIEW)
            */
        }

        public function chatListKeeper() 
        {
            require_once(VIEWS_PATH."validate-session.php");
            /*
            if(keeper)
            {
                chatList=chatDAO->getChatsForKeeper (crear metodo en chatDAO y procedure correspondiente)
            }
            else
            {
                chatList=chatDAO->getChatsForKeeper (crear metodo en chatDAO y procedure correspondiente)
                require_once(VIEWS_PATH."chat-list-keeper");
            }
            require once chatView (esto sería para compartir una chat view, CREAR CHAT VIEW)
            */
            require_once(VIEWS_PATH."chat-list-keeper");

        }

    }