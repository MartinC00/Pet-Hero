<?php 

	namespace Controllers;

	use Models\User;	
	use Models\eUserType as eUserType;
	use DAO\UserDAO;	

	class UserController
	{
		private $UserDAO;

		public function __construct()
		{
			$this->UserDAO = new UserDAO();
		}

		public function add ($username, $password, $name, $lastname, $dni, $phone, $email, $userType)
		{
			$user = new User();

			$user->setUsername($username);
			$user->setPassword($password);
			$user->setName($name);
			$user->setLastName($lastname);
			$user->setDni($dni);
			$user->setPhone($phone);
			$user->setEmail($email);
            $user->setUserType($userType);

			$check = $this->checkUser($user);

			if($check==1) { $this->showAddView("Username isn't available, please choose another one"); }
			else if($check==2) { $this->showAddView("DNI already exists !!"); }
			else if($check==3) { $this->showAddView("Email already exists !!"); }
			else
			{
				$this->UserDAO->add($user);
				$_SESSION["loggedUser"] = $user;
				$this->showAddView();
			}


			
		}
		public function showAddView($message='')
		{
			if(!isset($_SESSION["loggedUser"])) 
			{
				require_once(VIEWS_PATH . "add-user.php");
			}
			else if ($_SESSION["loggedUser"]->getUserType()== (eUserType::Keeper->name))
			{
				require_once(VIEWS_PATH . "add-keeper.php"); 
			}
			else
			{
				// require_once(VIEWS_PATH . "main-owner-panel") o algo asi
			}

		}

		private function checkUser($newUser) {
            $userList = $this->UserDAO->getAll();

            foreach ($userList as $user) 
            {
                if ($newUser->getUsername() == $user->getUsername()) return 1;
                
                else if($newUser->getDni() == $user->getDni()) return 2;
               
                else if($newUser->getEmail() == $user->getEmail()) return 3;
            }
            return 0;
        }
		public function showListView()
		{
			//ADAPTAR SEGUN KEEPER U OWNER

			$userList=$this->userDAO->getAll();
			require_once(VIEWS_PATH . "users-list.php");
		}
/*
		public function remove(//id o username)
		{
			$this->userDAO->delete(); //Dentro de la DAO uso la funcion delete() para no llamarla tambien remove()

			//adaptar segun usuario...

			$this-> // show algo

		}
*/

		public function modifyUserProfile()
		{


		}


	}

 ?>