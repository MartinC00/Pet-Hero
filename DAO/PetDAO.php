<?php 
	namespace DAO;

	use Models\Pet;
	use Models\PetType;
	use DAO\PetTypeDAO;
	use DAO\QueryType;
	
	class PetDAO {
		private $connection;
		private $tableName="Pets";
		private $petTypeDAO;

		function __construct()
		{
			$this->petTypeDAO = new PetTypeDAO();
		}

		public function add($pet)
		{		
			$query = "CALL Pets_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			//$query = "INSERT INTO ".$this->tableName." (idUser, idPetType, name, breed, size, description, photo, vaccines, video, isActive) values (:idUser, :idPetType, :name, :breed, :size, :description, :photo, :vaccines, :video, :isActive)";

			$parameters['idUser_']=$pet->getUserId();
            $parameters['idPetType_']=$pet->getPetType()->getId();
			$parameters['name_']=$pet->getName();
			$parameters['breed_']=$pet->getBreed();
			$parameters['size_']=$pet->getSize();
			$parameters['description_']=$pet->getDescription();
			$parameters['photo_']=$pet->getPhoto();
			$parameters['vaccines_']=$pet->getVaccines();
			$parameters['video_']=$pet->getVideo();
            $parameters['isActive_']=$pet->getIsActive();
            
			/* parameters para ejecutar query
            $parameters['idUser']=$pet->getUserId();
            $parameters['idPetType']=$pet->getPetType()->getId();
			$parameters['name']=$pet->getName();
			$parameters['breed']=$pet->getBreed();
			$parameters['size']=$pet->getSize();
			$parameters['description']=$pet->getDescription();
			$parameters['photo']=$pet->getPhoto();
			$parameters['vaccines']=$pet->getVaccines();
			$parameters['video']=$pet->getVideo();
            $parameters['isActive']=$pet->getIsActive();
			*/

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
	                $petType=$this->petTypeDAO->getById($row["idPetType"]); 

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
			$userPetList = array();
			$petList = $this->getAll();

			foreach($petList as $pet)
			{
				if($pet->getUserId()==$userId) array_push($userPetList, $pet);
			}
			return $userPetList;

			/*$query = "CALL Pets_getListByUserId(?)";
			$parameters["user_id"] =  $userId;
			try{
            	$this->connection = Connection::GetInstance();
            	$result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            	foreach($result as $row)
            	{
            		$pet= new Pet();
            		$pet->set

            	}
            	return $result;
			}
			catch(\PDOException $ex)
			{
				echo $ex->getMessage();
			}*/

		}
		public function getByIdQuery($id) //revisar, no funca
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

		public function modify(Pet $pet)
		{
			$query = "CALL Pets_modify(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			
			$parameters['id_']=$pet->getId();
			$parameters['idUser_']=$pet->getUserId();
            $parameters['idPetType_']=$pet->getPetType()->getId();
			$parameters['name_']=$pet->getName();
			$parameters['breed_']=$pet->getBreed();
			$parameters['size_']=$pet->getSize();
			$parameters['description_']=$pet->getDescription();
			$parameters['photo_']=$pet->getPhoto();
			$parameters['vaccines_']=$pet->getVaccines();
			$parameters['video_']=$pet->getVideo();
            $parameters['isActive_']=$pet->getIsActive();
			
			try{
            	$this->connection = Connection::GetInstance();
            	$result = $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            	return $result;
            }
            catch (\PDOException $ex){
            	echo $ex->getMessage();	
            }

		}

        public function getById($id)
        {
            $petList=$this->getAll();

            foreach($petList as $pet)
            {
                if($pet->getId()==$id) return $pet;
            }
            return null;
        }

        public function delete($id)
        {
        	$query = "CALL Pets_delete(?)";
			$parameters['idPet']=$id;
            
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
	}
 ?>