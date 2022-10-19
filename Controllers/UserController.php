<?php 

	namespace Controllers;

	use Models\User;	
	use Models\eUserType as eUserType;
	use DAO\UserDAO;	
	use DAO\UserTypeDAO;

	class UserController
	{
		private $UserDAO;
		private $UserTypeDAO;

		public function __construct()
		{
			$this->UserDAO = new UserDAO();
			$this->UserTypeDAO = new UserTypeDAO();
		}

		public function add ($username, $password, $name, $lastname, $DNI, $phoneNumber, $email, $userType)
		{
			//$userType = new UserType();
			//$newUserType->setId($UserTypeId);

			$user = new User();
			//$user->setUserType($newUserType);

			$user->setName($name);
			$user->setLastName($lastname);
			$user->setDNI($DNI);
			$user->setPhoneNumber($phoneNumber);
			$user->setEmail($email);
			$user->setUsername($username);
			$user->setPassword($password);
            $user->setUserType($userType);

			//Verificaciones antes de hacer el add...

			$this->UserDAO->Add($user);

			$this->showAddView($user->getUserType()->getUserTypeId());
			
		}

        private function checkUser($newUser) {
            $arr = $this->UserDAO->GetAll();

            foreach ($arr as $user) {
                if ($newUser->getUserName() == $user->getUserName()) {

                }
            }
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