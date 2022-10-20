<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;
    use Models\eUserType;

    class HomeController 
    {
        private $userDAO;

        public function __construct() {
            $this->userDAO = new UserDAO();
        }

        public function Index($message = "") {
            require_once(VIEWS_PATH."user-login.php");
        }

        public function showHomeView() 
        {
            require_once(VIEWS_PATH."validate-session.php");

            if($_SESSION["loggedUser"]->getUserType() == (eUserType::Keeper->name))
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
            $user = $this->userDAO->getByUsername($userName);

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

        public function Register($message="") {
            require_once(VIEWS_PATH."add-user.php");
        }

    }