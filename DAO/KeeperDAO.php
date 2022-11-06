<?php 
	namespace DAO;
	use Models\Keeper;
	use DAO\QueryType;

	class UserDAO
	{
		private $connection;
		private $tableName = "keepers";

		public function add($keeper)
		{
			$query = "CALL keepers_add(?, ?, ?, ?, ?, ?, ?, ?)";

			$parameters['userId']=$keeper->getUserId();
			$parameters['addressStreet']=$keeper->getAddressStreet();
			$parameters['addressNumber']=$keeper->getAddressNumber();
			$parameters['petSize']=$keeper->getPetSize();
			$parameters['initialDate']=$keeper->getInitialDate();
			$parameters['endDate']=$keeper->getEndDate();
			$parameters['days']=$keeper->getDays();
			$parameters['price']=$keeper->getPrice();

			try{
				$this->Connection = Connection::getInstance();
				return $this->Connection->ExecuteNonQuery($query,$parameters, QueryType::StoredProcedure, true);
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
		            $keeper->setDays($row["days"]);
		            $keeper->setPrice($row["price"]);
		            

	                array_push($keeperList, $keeper);
	            }

	            return $keeperList;
            }
            catch(\PDOException $ex){
				echo $ex->getMessage();
			}
		}
		
		public function getById($id)
        {
            $keeperList=$this->getAll();
            foreach($this->keeperList as $keeper)
            {
                if($keeper->getKeeperId()==$id) return $keeper;     
            }
            return null;
        }

        public function modify(Keeper $keeper)
        {
            $query = "CALL keepers_modify(?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $parameters['keeperId_']=$keeper->getKeeperId();
            $parameters['userId_']=$keeper->getUserId();
			$parameters['addressStreet']=$keeper->getAddressStreet();
			$parameters['addressNumber']=$keeper->getAddressNumber();
			$parameters['petSize']=$keeper->getPetSize();
			$parameters['initialDate']=$keeper->getInitialDate();
			$parameters['endDate']=$keeper->getEndDate();
			$parameters['days']=$keeper->getDays();
			$parameters['price']=$keeper->getPrice();

			try
			{
				$this->connection = Connection::getInstance();
				return $this->Connection->ExecuteNonQuery($query,$parameters, QueryType::StoredProcedure); //Me va a retornar filas afectadas, y si le pongo true, el ultimo id insertado
			}
			catch(\PDOException $ex)
			{
				echo $ex->getMessage();
			}
        }
			
		
		
	}


 ?>