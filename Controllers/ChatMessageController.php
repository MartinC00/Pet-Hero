<?php

    namespace Controllers;

    use Cassandra\Date;
    use DAO\ChatMessageDAO;
    use DateTime;
    use DateTimeZone;
    use Models\ChatMessage;

    class ChatMessageController {

        public $messageDAO;

        public function __construct() {
            $this->messageDAO = new ChatMessageDAO();
        }

        public function add($newMessage, $name, $chatId) {
            require_once(VIEWS_PATH."validate-session.php");
            $chatMessage = new ChatMessage();

            $chatMessage->setIdChat($chatId);
            $chatMessage->setIdSender($_SESSION["loggedUser"]->getId());
            $chatMessage->setMessage($newMessage);

            $d = new DateTime("now");
            $d->setTimezone(new DateTimeZone("America/Argentina/Buenos_Aires"));
            $d->format("Y-m-d H:i:s");
            $chatMessage->setDate($d);  // siempre al momento de generar un nuevo chat por default este está activo

            $this->messageDAO->add($chatMessage);

            $chatController = new ChatController();
            $chatController->showChatView($name, $chatId);

        }

        public function getListByChatId($chatId) {
            return $this->messageDAO->getListByChatId($chatId);
        }
    }