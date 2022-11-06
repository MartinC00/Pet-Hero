<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    //use DAO\UserTypeDAO as UserTypeDAO;
    use Controllers\UserController;
    //use Controllers\UserTypeController;
    use Models\User as User;
    use Models\UserType;

    class HomeController 
    {
        private $userController;
        //private $userTypeController;

        public function __construct() {
            $this->userController = new UserController();
            //$this->userTypeController = new UserTypeController();
        }

        public function Index($message = "") {
            require_once(VIEWS_PATH."user-login.php");
        }

        public function showHomeView() 
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            if($_SESSION["loggedUser"]->getUserType()->getId() === 2) //keeper = id: 2
            {
               require_once(VIEWS_PATH."keeper-home.php"); 
            }
            else
            {
               require_once(VIEWS_PATH."owner-home.php"); 
            }
        }

        public function Login($userName, $password) 
        {
            $user = $this->userController->UserDAO->getByUsername($userName);

            if(($user != null) && ($user->getPassword() === $password)) 
            {
                $_SESSION["loggedUser"] = $user;
                $this->showHomeView();
            } 
            else
            {
                $this->Index("Usuario y/o Contraseña incorrectos");
            }
        }

        public function Logout() {
            session_destroy();
            $this->Index();
        }

    }