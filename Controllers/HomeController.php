<?php
    namespace Controllers;

    use Controllers\UserController;
    use Models\User;
    use Models\UserType;

    class HomeController 
    {
        private $userController;

        public function __construct() {
            $this->userController = new UserController();
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
            $user = $this->userController->getByUsername($userName);

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