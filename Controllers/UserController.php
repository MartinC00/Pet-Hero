<?php 

	namespace Controllers;

	use Models\User;	
	use Models\UserType;
	use Controllers\UserTypeController;
	use DAO\UserDAO;	

	class UserController
	{
		private $userDAO;
		private $userTypeController;

		public function __construct()
		{
			$this->userDAO = new UserDAO();
			$this->userTypeController = new UserTypeController();
		}

		public function add ($username, $password, $name, $lastname, $dni, $phone, $email, $userTypeId)
		{
			$userType = new UserType();
			$userType = $this->userTypeController->getById($userTypeId);

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
					$this->userDAO->add($user);
					$user=$this->userDAO->getByUsername($user->getUsername());
					$_SESSION["loggedUser"] = $user;
					$this->showAddView();
				}
			}
			else $this->showAddView("Incorrect user type, please select right");
		}
		
		public function showAddView($message='')
		{
			if(!isset($_SESSION["loggedUser"])) 
			{
				$userTypeList = $this->userTypeController->getAll();
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
            $userList = $this->userDAO->getAll();

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
            $userList = $this->userDAO->getAll();

            foreach ($userList as $user) 
            {
                if ($newUser->getUsername() == $user->getUsername() && $user->getId()!=$newUser->getId()) return "Username isn't available, please choose another one";
                
                else if($newUser->getDni() == $user->getDni() && $user->getId()!=$newUser->getId()) return "DNI already exists !!";
               
                else if($newUser->getEmail() == $user->getEmail() && $user->getId()!=$newUser->getId()) return "Email already exists !!";
            }
            
            if($newUser->getPassword()==$_SESSION["loggedUser"]->getPassword())	return "Password is already in use";

            return 0;
        }
    
		public function modifyProfile($username, $password, $name, $lastname, $dni, $phone, $email)
		{
			require_once(VIEWS_PATH . "validate-session.php");

			$user = new User();
			$user->setId($_SESSION["loggedUser"]->getId());
			$user->setUserType($_SESSION["loggedUser"]->getUserType());
			$user->setUsername($username);
			$user->setPassword($password);
			$user->setName($name);
			$user->setLastName($lastname);
			$user->setDni($dni);
			$user->setPhone($phone);
			$user->setEmail($email);
			
			$verificationMessage = $this->checkUserModify($user);

			if($verificationMessage==0)
			{
				$this->userDAO->modify($user);
				$_SESSION["loggedUser"]=$user;
				$this->showHomeView("Profile modified !");
			}			 
			else 
				$this->showModifyUserProfile($verificationMessage); 			
		}
		
		public function getByUsername($username)
		{
			return $this->userDAO->getByUsername($username);
		}

		public function getById($id)
		{
			return $this->userDAO->getById($id);
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

		public function showHomeView($message='')
		{
			if($_SESSION["loggedUser"]->getUserType()->getId() == 1) require_once(VIEWS_PATH . "owner-home.php");
			else require_once(VIEWS_PATH . "keeper-home.php");
		}
	}

 ?>