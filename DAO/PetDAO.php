<?php 
	namespace DAO;
	use Models\Pet;
	use Models\PetType;
	use Controllers\PetTypeController;
	use DAO\PetTypeDAO;
	use DAO\QueryType;
	
	class PetDAO
	{
		private $connection;
		private $tableName="Pets";
		private $petTypeController;

		public function add($pet)
		{
			
			$query = "CALL Pets_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			
			$parameters['idUser']=$pet->getUserId();
            $parameters['idPetType']=$pet->getPetType()->getId(); //FOREIGN KEY
			$parameters['name']=$pet->getName();
			$parameters['breed']=$pet->getBreed();
			$parameters['size']=$pet->getSize();
			$parameters['description']=$pet->getDescription();
			$parameters['photo']=$pet->getPhoto();
			$parameters['vaccines']=$pet->getVaccines();
			$parameters['video']=$pet->getVideo();
            $parameters['isActive']=$pet->getIsActive();
            
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
			$petsList = array();

            $query = "CALL Pets_getAll()";

            try{        	
	            $this->connection = Connection::GetInstance();
	            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

	            foreach($result as $row)
	            {
	                $petType=$this->petTypeController->petTypeDAO->getById($row["idPetType"]); 

	                $pet = new Pet();
		            $pet->setPetType($petType);

		            $pet->setId($row["id"]);
		            $pet->setUserId($row["idUser"]);
		            $pet->setName($row["name"]);
		            $pet->setBreed($row["breed"]);
		            $pet->setSize($row["size"]);
		            $pet->setDescription($row["description"]);
		            $pet->setPhoto($row["photo"]);
		            $pet->setVaccines($row["vaccines"]);
		            $pet->setVideo($row["video"]);
		            $pet->setIsActive($row["isActive"]);

	                array_push($petsList, $pet);
	            }

	            return $petsList;
            }
            catch(\PDOException $ex){
				echo $ex->getMessage();
			}
		}
		
		public function getListByUserId($userId) //CAMBIAR NOMBRE EN LA CONTROLLER Y VISTAS ASOCIADAS
		{
			$query = "CALL Pets_getListByUserId(?)";
			$parameters["user_id"] =  $userId;
			try{
            	$this->connection = Connection::GetInstance();
            	$result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
            	return $result;
			}
			catch(\PDOException $ex)
			{
				echo $ex->getMessage();
			}

		}
		public function getById($id)
		{
			$query = "CALL Pets_getById(?)";
			$parameters["pet_id"]=$id;
			try{
            	$this->connection = Connection::GetInstance();
            	$result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
            	return $result;
            }
            catch (\PDOException $ex){
            	echo $ex->getMessage();	
            }

		}

		

		//pendientes: delete (change boolean isActive), modify











	}
 ?>