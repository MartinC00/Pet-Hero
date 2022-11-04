<?php 
	namespace DAO;
	use Models\PetType;
	use DAO\QueryType;
	use DAO\Connection;

	class PetTypeDAO
	{
		private $connection;
		private $tableName="PetTypes";

		public function add($pet)
		{		
			$query = "CALL PetTypes_add(?)";
			//$query = " INSERT INTO ". $this->tableName." (name) VALUES (:name)"; asi seria si la query type fuese query
			$parameters['name']=$pet->getUserId();
            
			try{
				$this->Connection = Connection::getInstance();
				return $this->Connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (\PDOException $ex){
				echo $ex->getMessage();
			}
		}

		public function getAll()
		{
			$petTypesList = array();
            //$query = 'CALL PetTypes_getAll';
            $query = "SELECT * FROM " . $this->tableName;

            try{
            	$this->connection = Connection::GetInstance();
            	$result = $this->connection->Execute($query);

	            foreach($result as $row)
	            {
	            	$petType = new petType();
	                $petType->setId($row["id"]);
	                $petType->setName($row["name"]);

	                array_push($petTypesList, $petType);
	            }
            
            	return $petTypesList;
            }
            catch (\PDOException $ex){
            	echo $ex->getMessage();	
            }
		}

		public function getById($petTypeId)
		{
			$query = "CALL PetTypes_getById(?)";
			$parameters["idPetType"]=$petTypeId;
			
			try{
            	$this->connection = Connection::GetInstance();
            	$result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
            	return $result;
            }
            catch (\PDOException $ex){
            	echo $ex->getMessage();	
            }

		}

		/*public function getById($petTypeId)
		{
			$petTypesList=$this->getAll();
			foreach($petTypesList as $petType)
			{
				if($petType->getId()==$petTypeId) return $petType;
			}
			return null;
		}*/
	}


 ?>