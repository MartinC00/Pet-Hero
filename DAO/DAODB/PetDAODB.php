<?php 
	namespace DAO;
	use Models\Pet;
	
	class PetDAO
	{
		public function create($pet){
			$sql= "INSERT INTO pets (ownerId,name,breed,size,description,photo,vaccines,video,petType,isActive) VALUES (:ownerId,:name,:breed,:size,:description,:photo,:vaccines,:video,:petType,:isActive)";

			$parameters['ownerId']=$pet->getOwnerId();
			$parameters['name']=$pet->getName();
			$parameters['breed']=$pet->getBreed();
			$parameters['size']=$pet->getSize();
			$parameters['description']=$pet->getDescription();
			$parameters['photo']=$pet->getPhoto();
			$parameters['vaccines']=$pet->getVaccines();
			$parameters['video']=$pet->getVideo();
            $parameters['petType']=$pet->getPetType();
            $parameters['isActive']=$pet->getIsActive();
            

			try{
				$this->Connection = Connection::getInstance();
				return $this->Connection->ExecuteNonQuery($sql,$parameters);
			}catch(\PDOException $ex){
				throw $ex;
			}
		}

		public function addKeeper($pet){
			$Dpet = new PetDAO;
			$fileController = new FileController();
			if($fileController ->upload()){
				try{
					$pet->create($pet);
					return true;
				}catch(\PDOException $ex){
					throw $ex;
				}
			}else{
				return false;
			}
		}
	}


 ?>