<?php
    namespace Controllers;
    use Models\UserType;
    use DAO\UserTypeDAO;

    class UserTypeController
    {
        public $userTypeDAO;

        public function __construct()
        {
            $this->userTypeDAO = new UserTypeDAO();
        }
        
        public function add($nameType)
        {
            $userType = new UserType();
            $userType->setNameType($nameType);
            $this->userTypeDAO->add($userType);
            $this->showAddView();
        }

        public function showAddView()
        {
            require_once(VIEWS_PATH."add-user-type.php");
        }

        public function showListView()
        {
            $userTypeList = $this->userTypeDAO->getAll();
            require_once(VIEWS_PATH."user-type-list.php");
        }
        public function getAll()
        {
            return $this->userTypeDAO->getAll();
        }
        public function getById($id)
        {
            return $this->userTypeDAO->getById($id);
        }
    }
?>