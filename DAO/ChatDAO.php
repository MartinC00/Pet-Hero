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
        public function getAll()
        {
            $chatList = array();
            $query = "CALL chats_getAll()";

            try{            
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
                foreach($result as $row)
                {
                    $chat = new Chat();
                    $pet->setId($row["id"]);
                    $pet->setIdUserKeeper($row["idUserKeeper"]);
                    $pet->setIdUserOwner($row["idUserOwner"]);
                    $pet->setStatus($row["status"]);

                    array_push($chatList, $chat);
                }

                return $petsList;
            }
            catch(\PDOException $ex){
                echo $ex->getMessage();
            }

        }
        public function getByIds($idUserOwner, $idUserKeeper)
        {
            $chatList = array();
            $query = "CALL chats_getByIds(?, ?)";

            $parameters['idUserOwner_']= $idUserOwner;
            $parameters['idUserKeeper_']= $idUserKeeper;

            try{            
                $this->connection = Connection::GetInstance();
                $chat = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
                return $chat;
            }
            catch(\PDOException $ex){
                echo $ex->getMessage();
            }

        }
        public function getById($id)
        {
            $chatList=$this->getAll();
            foreach($chatList as $chat)
            {
                if($chat->getId()==$id) return $chat;
            }
            return null;
        }
    }