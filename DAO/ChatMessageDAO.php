<?php

    namespace DAO;

    use Models\ChatMessage;

    class ChatMessageDAO {

        public function add(ChatMessage $chatMessage) {
            $query = "CALL chats_add(?, ?, ?)";

            $parameters['idChat_']= $chatMessage->getIdChat();
            $parameters['idSender_']= $chatMessage->getIdSender();
            $parameters['message_']= $chatMessage->getMessage();
            $parameters['date_'] = $chatMessage->getDate();

            try {
                $this->Connection = Connection::getInstance();
                return $this->Connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            } catch(\PDOException $ex) {
                echo $ex->getMessage();
            }
        }
        public function getListByChatId($idChat)
        {
            $query = "CALL messages_byChatId(?)";
            $parameters['idChat_']= $idChat;
            
            try {
                $this->Connection = Connection::getInstance();
                return $this->Connection->Execute($query, $parameters, QueryType::StoredProcedure);
            } catch(\PDOException $ex) {
                echo $ex->getMessage();
            }
        }
    }