<?php 
	namespace DAO;

	use Models\User;
	use Models\UserType;
	use DAO\UserTypeDAO;
	
	class UserDAO implements IUserDAO 
	{
		private $connection;
		private $tableName = "Users";
		private $userTypeDAO;

		public function __construct()
		{
			$this->userTypeDAO = new UserTypeDAO;
		}

		public function add($user)
		{		
			$query = "CALL Users_add(?, ?, ?, ?, ?, ?, ?,?)";

            $parameters['username_']=$user->getUsername();
			$parameters['password_']=$user->getPassword();
			$parameters['name_']=$user->getName();
			$parameters['lastname_']=$user->getLastname();
			$parameters['dni_']=$user->getDni();
			$parameters['phone_']=$user->getPhone();
			$parameters['email_']=$user->getEmail();
			$parameters['userTypeId_']=$user->getUserType()->getId();
            
			try
			{
				$this->connection = Connection::getInstance();
				$this->connection->ExecuteNonQuery($query,$parameters, QueryType::StoredProcedure, true); //Me va a retornar filas afectadas, y si le pongo true, el ultimo id insertado
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
	            	$userType = new UserType();
	            	$userType = $this->userTypeDAO->getById($row["userTypeId"]);

	                $user = new User();
		            $user->setId($row["id"]);
		            $user->setUsername($row["username"]);
		            $user->setPassword($row["password"]);
		            $user->setName($row["name"]);
		            $user->setLastname($row["lastname"]);
		            $user->setDni($row["dni"]);
		            $user->setPhone($row["phone"]);
		            $user->setEmail($row["email"]);
		            $user->setUserType($userType);
		           
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
            foreach($userList as $user)
            {
                if($user->getUsername()==$username) return $user;
            }
            return null;
        }

        public function getById($id)
        {
            $userList=$this->getAll();
            foreach($userList as $user)
            {
                if($user->getId()==$id) return $user;     
            }
            return null;
        }

        public function modify(User $user)
        {
            $query = "CALL Users_modify(?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $parameters['id_']=$user->getId();
            $parameters['username_']=$user->getUsername();
			$parameters['password_']=$user->getPassword();
			$parameters['name_']=$user->getName();
			$parameters['lastname_']=$user->getLastname();
			$parameters['dni_']=$user->getDni();
			$parameters['phone_']=$user->getPhone();
			$parameters['email_']=$user->getEmail();
			$parameters['userTypeId_']=$user->getUserType()->getId();

			try
			{
				$this->connection = Connection::getInstance();
				$this->connection->ExecuteNonQuery($query,$parameters, QueryType::StoredProcedure); //Me va a retornar filas afectadas, y si le pongo true, el ultimo id insertado
			}
			catch(\PDOException $ex)
			{
				echo $ex->getMessage();
			}
        }
        public function getOwnerName($idOwner)
        {
        	return $this->getById($idOwner)->getName();
        }

	}

 ?>