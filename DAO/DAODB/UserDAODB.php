<?php 
	namespace DAO;
	use Models\User;
	
	class UserDAO implements IUserDAO 
	{
		private $Connection;
		private $tableName = "Users";

		public function add($user)
		{		
			$query = "CALL Users_add(?, ?, ?, ?, ?, ?, ?,?)";

            $parameters['username']=$user->getUsername();
			$parameters['password']=$user->getPassword();
			$parameters['name']=$user->getName();
			$parameters['lastname']=$user->getLastname();
			$parameters['dni']=$user->getDni();
			$parameters['phone']=$user->getPhone();
			$parameters['email']=$user->getEmail();
			$parameters['userType']=$user->getUserType();
            
			try
			{
				$this->Connection = Connection::getInstance();
				return $this->Connection->ExecuteNonQuery($query,$parameters, QueryType::StoredProcedure, true); //Me va a retornar filas afectadas, y si le pongo true, el ultimo id insertado
			}
			catch(\PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}

		public function getAll()
		{
			$userList = array();
            $query = "SELECT * FROM ".$this->tableName;

            try{        	
	            $this->connection = Connection::GetInstance();
	            $result = $this->connection->Execute($query);
	            foreach($result as $row)
	            {
	                $user = new User();
		            $user->setId($row["id"]);
		            $user->setUsername($row["username"]);
		            $user->setPassword($row["password"]);
		            $user->setPassword($row["name"]);
		            $user->setPassword($row["lastname"]);
		            $user->setPassword($row["dni"]);
		            $user->setPassword($row["phone"]);
		            $user->setPassword($row["email"]);
		            $user->setPassword($row["userType"]);
		           
	                array_push($userList, $user);
	            }

	            return $userList;
            }
            catch(\PDOException $ex){
				echo $ex->getMessage();
			}
		}

		public function getByUsername($username)
        {
            $userList=$this->getAll();
            foreach($this->userList as $user)
            {
                if($user->getUsername()==$username) return $user;
            }
            return null;
        }

        public function getById($id)
        {
            $userList=$this->getAll();
            foreach($this->userList as $user)
            {
                if($user->getId()==$id) return $user;     
            }
            return null;
        }

        public function modify(User $user)
        {
            $query = "CALL Users_modify(?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $parameters['id']=$user->getId();
            $parameters['username']=$user->getUsername();
			$parameters['password']=$user->getPassword();
			$parameters['name']=$user->getName();
			$parameters['lastname']=$user->getLastname();
			$parameters['dni']=$user->getDni();
			$parameters['phone']=$user->getPhone();
			$parameters['email']=$user->getEmail();
			$parameters['userType']=$user->getUserType();

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