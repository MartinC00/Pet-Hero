<?php

    namespace DAO;

    use Models\Reserve;

    class ReserveDAO implements IReserveDAO
    {
        private $connection;

        public function add($reserve)
        {
            $query = "CALL reserves_add(?, ?, ?, ?, ?, ?, ?)";

            $parameters['idUserOwner_']=$reserve->getIdUserOwner();
            $parameters['idKeeper_']=$reserve->getIdKeeper();
            $parameters['idPets_']=implode("," , $reserve->getIdPets());
            $parameters['initialDate_']=$reserve->getInitialDate();
            $parameters['endDate_']=$reserve->getEndDate();
            $parameters['totalPrice_']=$reserve->getTotalPrice();    
            $parameters['reserveStatus_']=$reserve->getReserveStatus();    


            try
            {
                $this->Connection = Connection::getInstance();
                return $this->Connection->ExecuteNonQuery($query,$parameters, QueryType::StoredProcedure); //Me va a retornar filas afectadas, y si le pongo true, el ultimo id insertado
            }
            catch(\PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }

        public function getAll() 
        {
            $reserveList = array();
            $query = "CALL reserves_getAll()";

            try{            
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                foreach($result as $row)
                {
                    $reserve = new Reserve();
                    $reserve->setId($row["id"]);
                    $reserve->setIdUserOwner($row["idUserOwner"]);
                    $reserve->setIdKeeper($row["idKeeper"]);
                    $reserve->setIdPets(explode("," , $row["idPets"]));
                    $reserve->setInitialDate($row["initialDate"]);
                    $reserve->setEndDate($row["endDate"]);
                    $reserve->setTotalPrice($row["totalPrice"]);
                    $reserve->setReserveStatus($row["reserveStatus"]);
                    
                    array_push($reserveList, $reserve);
                }
                return $reserveList;
            }
            catch(\PDOException $ex){
                echo $ex->getMessage();
            }
        }

        public function getReservesByKeeper($idKeeper) {
            $reserveList = $this->getAll();

            foreach($reserveList as $reserve)
            {
                if($reserve->getIdKeeper()==$idKeeper)
                {
                    array_push($reserveList, $reserve); //lista de reservas de ESE keeper
                }
            }
            return $reserveList;
        }

        public function getByOwnerId($idUserOwner)
        {
            $reserveList=$this->getAll();
            $reserveListFiltered = array();
            foreach($reserveList as $reserve)
            {
                if($reserve->getIdUserOwner()==$idUserOwner) array_push($reserveListFiltered, $reserve);
            }
            return $reserveListFiltered;
        }

        public function getByKeeperOwnerId($idKeeper, $idUserOwner)
        {
            $reserveList=$this->getReservesByKeeper($idKeeper);
            $reserveListKeeperOwner = array();
            foreach($reserveList as $reserve)
            {
                if($reserve->getIdUserOwner()==$idUserOwner) array_push($reserveListKeeperOwner, $reserve);
            }
            return $reserveListKeeperOwner;
        }
    }