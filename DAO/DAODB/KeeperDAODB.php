<?php 
	namespace DAO;
	use Models\Keeper;
	
	class UserDAO
	{
		public function create($keeper){
			$sql= "INSERT INTO keepers (userId,address_street,address_number,petSize,initialDate,endDate,days,price) VALUES (:userId,:address_street,:address_number,:petSize,:initialDate,:endDate,:days,:price)";

			$parameters['userId']=$keeper->getUserId();
			$parameters['address_street']=$keeper->getAddressStreet();
			$parameters['address_number']=$keeper->getAddressNumber();
			$parameters['petSize']=$keeper->getPetSize();
			$parameters['initialDate']=$keeper->getInitialDate();
			$parameters['endDate']=$keeper->getEndDate();
			$parameters['days']=$keeper->getDays();
			$parameters['price']=$keeper->getPrice();

			try{
				$this->connection = Connection::getInstance();
				return $this->connection->executeNonQuert($sql,$parameters);
			}catch(\PDOException $ex){
				throw $ex;
			}
		}

		public function addUser($keeper){
			$Dkeeper = new KeeperDAO;
			$fileController = new fileController();
			if($fileController ->upload(){
				try{
					$user->create($keeper);
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