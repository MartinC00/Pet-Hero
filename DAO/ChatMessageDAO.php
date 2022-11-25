<?php

    namespace DAO;

    use Models\ChatMessage;

    class ChatMessageDAO {

        private $connection;
        private $tableName = "messages";

        public function add(ChatMessage $chatMessage) {

            $query = "CALL messages_add(?, ?, ?, ?)";

            $parameters['idChat_']= $chatMessage->getIdChat();
            $parameters['idSender_']= $chatMessage->getIdSender();
            $parameters['message_']= $chatMessage->getMessage();
            $parameters['date_'] = $chatMessage->getDate()->format("Y-m-d H:i:s");

            try {
                $this->connection = Connection::getInstance();
                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            } catch(\PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        public function getListByChatId($chatId) {
            $query = "CALL messages_byChatId(?)";

            $parameters['chatId_'] = $chatId;

            $list = array();
            
            try {
                $this->connection = Connection::getInstance();
                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                foreach ($result as $row) {
                    $message = new ChatMessage();

                    $message->setId($row["id"]);
                    $message->setIdChat($row["chatId"]);
                    $message->setIdSender($row["idSender"]);
                    $message->setMessage($row["message"]);
                    $message->setDate($row["date"]);

                    array_push($list, $message);
                }

                return $list;

            } catch(\PDOException $ex) {
                echo $ex->getMessage();
            }
            return null;
        }
    }