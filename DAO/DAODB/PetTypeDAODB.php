<?php 
	namespace DAO;
	use Models\PetType;
	
	class PetTypeDAO
	{
		public function create($petType){
			$sql= "INSERT INTO pettype (name) VALUES ('Perro'),('Gato')";

			try{
				$this->Connection = Connection::getInstance();
				return $this->Connection->ExecuteNonQuery($sql);
			}catch(\PDOException $ex){
				throw $ex;
			}
		}
        /*
		public function addKeeper($keeper){
			$Dkeeper = new KeeperDAO;
			$fileController = new FileController();
			if($fileController ->upload()){
				try{
					$keeper->create($keeper);
					return true;
				}catch(\PDOException $ex){
					throw $ex;
				}
			}else{
				return false;
			}
		}*/
	}


 ?>