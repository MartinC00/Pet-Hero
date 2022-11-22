<?php

    namespace DAO;

    use Models\Chat;

    class ChatDAO {

        public function add(Chat $chat) {
            $query = "CALL chats_add(?, ?, ?)";

            $parameters['idUserOwner_']= $chat->getIdUserOwner();
            $parameters['idUserKeeper_']= $chat->getIdUserKeeper();
            $parameters['status_'] = $chat->getStatus();

            try {
                $this->Connection = Connection::getInstance();
                return $this->Connection->ExecuteNonQuery($query,$parameters, QueryType::StoredProcedure);
            } catch(\PDOException $ex) {
                echo $ex->getMessage();
            }
        }
    }