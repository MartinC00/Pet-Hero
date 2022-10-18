<?php 

	namespace Controllers;
	use Models\User;	
	use Models\UserType;	
	use DAO\UserDAO;	
	use DAO\UserTypeDAO;

	class UserController()
	{
		private $UserDAO;
		private $UserTypeDAO;

		public function __construct()
		{
			$this->UserDAO = new UserDAO();
			$this->UserTypeDAO = new UserTypeDAO();
		}

		public function add($name, $lastname, $DNI, $phoneNumber, $email, $username, $password, $UserTypeId)
		{
			$userType = new UserType();
			$newUserType->setId($UserTypeId);

			$user = new User();
			$user->setUserType($newUserType);

			$user->setName($name)
			$user->setLastName($lastname);
			$user->setDNI($DNI);
			$user->setPhoneNumber($phoneNumber);
			$user->setEmail($email);
			$user->setUsername($username);
			$user->setPassword($password);

			//Verificaciones antes de hacer el add...

			$this->UserDAO->Add($user);

			$this->showAddView($user->getUserType()->getUserTypeId());
			
		}
		public function showAddView($userTypeId)
		{
			if($userTypeId==2)
			{
				require_once(VIEWS_PATH . "completing-keeper-info.php"); //si el id=2, es un keeper, entonces muestro la vista para cargar los atributos particulares del keeper
			}


		}
		public function remove()
		{

		}

	}

 ?>