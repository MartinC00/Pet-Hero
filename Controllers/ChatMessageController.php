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

        public function add($message) {
            require_once(VIEWS_PATH."validate-session.php");
            $chat = new ChatMessage();

            $chat->setIdSender($_SESSION["loggedUser"]->getId());
            $chat->setMessage($message);

            $d = new DateTime("now");
            $d->setTimezone(new DateTimeZone("America/Argentina/Buenos_Aires"));
            $d->format("Y-m-d H:i:s");
            $chat->setDate($d);  // siempre al momento de generar un nuevo chat por default este está activo

            $this->messageDAO->add($message);
        }
    }