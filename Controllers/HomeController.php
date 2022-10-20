<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class HomeController {
        private $userDAO;

        public function __construct() {
            $this->userDAO = new UserDAO();
        }

        public function Index($message = "") {
            require_once(VIEWS_PATH."user-login.php");
        }

        public function ShowAddView() {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."main-owner-view.php"); // TODO redireccionar
        }

        public function Login($userName, $password) 
        {
            $user = $this->userDAO->getByUsername($userName);

            if(($user != null) && ($user->getPassword() === $password)) {
                $_SESSION["loggedUser"] = $user;
                $this->ShowAddView();
            } else
                $this->Index("Usuario y/o Contraseña incorrectos");
        }

        public function Logout() {
            session_destroy();

            $this->Index();
        }

        public function Register($message="") {
            require_once(VIEWS_PATH."add-user.php");
        }

    }