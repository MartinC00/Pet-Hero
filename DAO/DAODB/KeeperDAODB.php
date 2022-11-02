<?php 
	namespace DAO;
	use Models\Keeper;
	
	class KeeperDAO
	{
		public function create($keeper){
			$sql= "INSERT INTO keepers (adress_street,anddress_number,petSize,initialDate,endDate,days,price) VALUES (:adress_street,:anddress_number,:petSize,:initialDate,:endDate,:days,:price)";

			$parameters['address_street']=$keeper->getAddress_street();
			$parameters['address_number']=$keeper->getAddress_number();
			$parameters['petSize']=$keeper->getPetSize();
			$parameters['initialDate']=$keeper->getInitialDate();
			$parameters['endDate']=$user->getEndDate();
			$parameters['days']=$user->getDays();
			$parameters['price']=$user->getPrice();
			//$parameters['userType']=$user->getUserType();

			try{
				$this->connection = Connection::getInstance();
				return $this->connection->executeNonQuert($sql,$parameters);
			}catch(\PDOException $ex){
				throw $ex;
			}
		}

		public function addKeeper($keeper){
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