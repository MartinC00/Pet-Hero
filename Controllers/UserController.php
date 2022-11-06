<?php 

	namespace Controllers;

	use Models\User;	
	use Models\UserType as UserType;
	use Controllers\UserTypeController as UserTypeController;
	use DAO\UserTypeDAO as UserTypeDAO;	
	use DAO\UserDAO as UserDAO;	

	class UserController
	{
		public $UserDAO;
		public $userTypeController;

		public function __construct()
		{
			$this->UserDAO = new UserDAO();
			$this->userTypeController = new UserTypeController();
		}

		public function add ($username, $password, $name, $lastname, $dni, $phone, $email, $userTypeId)
		{
			$userType = new UserType();
			$userType = $this->userTypeController->userTypeDAO->getById($userTypeId);

			if($userType)
			{				
				$user = new User();
				$_SESSION["loggedUser"]=null;

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
					$user=$this->UserDAO->getByUsername($user->getUsername());
					$_SESSION["loggedUser"] = $user;
					$this->showAddView();
				}
			}
			else showAddView("Incorrect user type, please select right");
		}
		
		public function showAddView($message='')
		{
			if(!isset($_SESSION["loggedUser"])) 
			{
				$userTypeList = $this->userTypeController->userTypeDAO->getAll();
				require_once(VIEWS_PATH . "add-user.php");
			}
			else if ($_SESSION["loggedUser"]->getUserType()->getId() == 2)
			{
				require_once(VIEWS_PATH . "add-keeper.php"); 
			}
			else
			{
				require_once(VIEWS_PATH . "owner-home.php");
			}

		}

		private function checkUser($newUser) 
		{
            $userList = $this->UserDAO->getAll();

            foreach ($userList as $user) 
            {
                if ($newUser->getUsername() == $user->getUsername()) return 1;
                
                else if($newUser->getDni() == $user->getDni()) return 2;
               
                else if($newUser->getEmail() == $user->getEmail()) return 3;
            }
            return 0;
        }

        private function checkUserModify($newUser) 
		{
            $userList = $this->UserDAO->getAll();

            foreach ($userList as $user) 
            {
                if ($newUser->getUsername() == $user->getUsername() && $user->getId()!=$newUser->getId()) return 1;
                
                else if($newUser->getDni() == $user->getDni() && $user->getId()!=$newUser->getId()) return 2;
               
                else if($newUser->getEmail() == $user->getEmail() && $user->getId()!=$newUser->getId()) return 3;
            }
            return 0;
        }
    
		public function modifyProfile($username, $password, $name, $lastname, $dni, $phone, $email)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			
			$user = $_SESSION["loggedUser"];

			$user->setUsername($username);
			$user->setPassword($password);
			$user->setName($name);
			$user->setLastName($lastname);
			$user->setDni($dni);
			$user->setPhone($phone);
			$user->setEmail($email);
			
			$check = $this->checkUserModify($user);

			if($check==1) { $this->showModifyUserProfile("Username isn't available, please choose another one"); }
			else if($check==2) { $this->showModifyUserProfile("DNI already exists !!"); }
			else if($check==3) { $this->showModifyUserProfile("Email already exists !!"); }
			else
			{
				$this->UserDAO->modify($user);
				$_SESSION["loggedUser"]=$user;
				$this->showHomeView();
			}			
		}

        public function showMyProfile()
        {
        	require_once(VIEWS_PATH . "validate-session.php");
        	$user = $_SESSION["loggedUser"];
        	require_once(VIEWS_PATH . "user-profile.php");
        }

        public function showModifyUserProfile($message="")
        {
        	require_once(VIEWS_PATH . "validate-session.php");
        	$user = $_SESSION["loggedUser"];
        	require_once(VIEWS_PATH . "modify-user-profile.php");
        }

		public function showHomeView()
		{
			if($_SESSION["loggedUser"]->getUserType()->getId() === 1) require_once(VIEWS_PATH . "owner-home.php");
			else require_once(VIEWS_PATH . "keeper-home.php");
		}



/* 
		public function showListView() no tiene uso, no se deberia poder mostrar todos los usuarios a nadie que no sea admin
		{
			//ADAPTAR SEGUN KEEPER U OWNER

			$userList=$this->userDAO->getAll();
			require_once(VIEWS_PATH . "users-list.php");
		}

		public function remove(//id o username) 
		{
			$this->userDAO->delete(); //Dentro de la DAO uso la funcion delete() para no llamarla tambien remove()

			//adaptar segun usuario...

			$this-> // show algo

		} //por el momento no tiene uso, salvo que el user quiera eliminarse a si mismo o un admin lo haga
*/

		


	}

 ?>