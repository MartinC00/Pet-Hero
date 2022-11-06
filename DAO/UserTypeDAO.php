<?php 
	namespace DAO;
	use Models\UserType;
	use DAO\QueryType;
	use DAO\Connection;

	class UserTypeDAO
	{
		private $connection;
		private $tableName="UserTypes";

		public function add($userType)
		{		
			$query = " INSERT INTO ". $this->tableName." (nameType) VALUES (:nameType)";
			$parameters['nameType']=$userType->getNameType();
            
			try{
				$this->connection = Connection::getInstance();
				return $this->Connection->ExecuteNonQuery($query, $parameters);
			}
			catch (\PDOException $ex){
				echo $ex->getMessage();
			}
		}

		public function getAll()
		{
			$userTypeList = array();
            $query = "SELECT * FROM ".$this->tableName;

            try{
            	$this->connection = Connection::GetInstance();
            	$result = $this->connection->Execute($query, array());
	            foreach($result as $row)
	            {
	            	$userType = new UserType();
	                $userType->setId($row["id"]);
	                $userType->setNameType($row["nameType"]);

	                array_push($userTypeList, $userType);
	            }
            	return $userTypeList;
            }
            catch (\PDOException $ex){
            	echo $ex->getMessage();	
            }
		}

		public function getById($userTypeId)
		{
			$query = "CALL UserTypes_getById(?)";
			$parameters["idUserType"]=$userTypeId;
			
			try{
            	$this->connection = Connection::GetInstance();
            	$result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
            	
            	$userType=new UserType();
            	$userType->setId($result[0]["id"]);
            	$userType->setNameType($result[0]["nameType"]);
            	
            	return $userType;
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