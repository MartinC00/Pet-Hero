<?php 
	namespace DAO;
	use Models\User;
	
	class UserDAO
	{
		public function create($user){
			$sql= "INSERT INTO users (surname,password,name,lastname,dni,phone,email,userType) VALUES (:surname,:password,:name,:lastname,:dni,:phone,:email,:userType)";

			$parameters['surname']=$user->getName();
			$parameters['password']=$user->getPassword();
			$parameters['name']=$user->getName();
			$parameters['lastname']=$user->getLastname();
			$parameters['dni']=$user->getDni();
			$parameters['phone']=$user->getPhone();
			$parameters['email']=$user->getEmail();
			$parameters['userType']=$user->getUserType();

			try{
				$this->connection = Connection::getInstance();
				return $this->connection->executeNonQuert($sql,$parameters);
			}catch(\PDOException $ex){
				throw $ex;
			}
		}

		public function addUser($user){
			$Duser = new UserDAO;
			$fileController = new fileController();
			if($fileController ->upload(){
				try{
					$user->create($user);
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