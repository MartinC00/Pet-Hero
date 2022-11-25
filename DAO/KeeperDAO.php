<?php 
	namespace DAO;
	use Models\Keeper;
	use DAO\QueryType;
	use DAO\UserDAO;

	class KeeperDAO
	{
		private $connection;
		private $tableName = "keepers";

		public function add($keeper)
		{
			$query = "CALL keepers_add(?, ?, ?, ?, ?, ?, ?, ?)";

			$parameters['userId_']=$keeper->getUserId();
			$parameters['addressStreet_']=$keeper->getAddressStreet();
			$parameters['addressNumber_']=$keeper->getAddressNumber();
			$parameters['petSize_']=$keeper->getPetSize();
			$parameters['initialDate_']=$keeper->getInitialDate();
			$parameters['endDate_']=$keeper->getEndDate();
			$parameters['days_']= implode(",", $keeper->getDays());
			$parameters['price_']=$keeper->getPrice();

			try{
				$this->connection = Connection::getInstance();
				$this->connection->ExecuteNonQuery($query,$parameters, QueryType::StoredProcedure, true);
			}catch(\PDOException $ex){
				throw $ex;
			}
		}

		public function getAll()
		{
			$keeperList = array();
            $query = "SELECT * FROM ".$this->tableName;

            try{        	
	            $this->connection = Connection::GetInstance();
	            $result = $this->connection->Execute($query);
	            foreach($result as $row)
	            {
	                $keeper = new Keeper();
		            $keeper->setKeeperId($row["keeperId"]);
		            $keeper->setUserId($row["userId"]);
		            $keeper->setAddressStreet($row["addressStreet"]);
		            $keeper->setAddressNumber($row["addressNumber"]);
		            $keeper->setPetSize($row["petSize"]);
		            $keeper->setInitialDate($row["initialDate"]);
		            $keeper->setEndDate($row["endDate"]);
		            $keeper->setDays(explode("," , $row["days"]));
		            $keeper->setPrice($row["price"]);

	                array_push($keeperList, $keeper);
	            }

	            return $keeperList;
            }
            catch(\PDOException $ex){
				echo $ex->getMessage();
			}
		}

		public function getFullListForOwner()
		{
			$chatDAO = new ChatDAO();
			$keeperList = array();
			$query = "CALL keepers_list()";           

			try
			{
				$this->connection = Connection::getInstance();
				$result=$this->connection->Execute($query, array(), QueryType::StoredProcedure); 

				foreach($result as $row)
				{
					$chat=$chatDAO->getByIds($_SESSION['loggedUser']->getId(), $row["userId"]);	
					if($chat) $row["chat"]=$chat[0];
					else $row["chat"]=null;
					array_push($keeperList, $row);
				}
				return $keeperList;
			}
			catch(\PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}
		
		public function getById($id)
        {
            $keeperList=$this->getAll();
            foreach($keeperList as $keeper)
            {
                if($keeper->getKeeperId()==$id) return $keeper;
            }
            return null;
        }

        public function getByUserId($userId)
        {
        	$keepersList=$this->getAll();
        	foreach($keepersList as $keeper)
        	{
        		if($keeper->getUserId()==$userId) return $keeper;
        	}
        	return null;
        }

        public function modify(Keeper $keeper)
        {
            $query = "CALL keepers_modify(?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $parameters['keeperId_']=$keeper->getKeeperId();
            $parameters['userId_']=$keeper->getUserId();
			$parameters['addressStreet_']=$keeper->getAddressStreet();
			$parameters['addressNumber_']=$keeper->getAddressNumber();
			$parameters['petSize_']=$keeper->getPetSize();
			$parameters['initialDate_']=$keeper->getInitialDate();
			$parameters['endDate_']=$keeper->getEndDate();
			$parameters['days_']= implode(",", $keeper->getDays());
			$parameters['price_']=$keeper->getPrice();

			try
			{
				$this->connection = Connection::getInstance();
				$this->connection->ExecuteNonQuery($query,$parameters, QueryType::StoredProcedure); //Me va a retornar filas afectadas, y si le pongo true, el ultimo id insertado
			}
			catch(\PDOException $ex)
			{
				echo $ex->getMessage();
			}
        }

        public function getKeeperName($idKeeper)
        {
        	$userDAO = new UserDAO();
        	$keeper=$this->getById($idKeeper);
            $user=$userDAO->getById($keeper->getUserId());

            return $user->getName();
        }


    }
 ?> 
