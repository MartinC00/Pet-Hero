<?php
    namespace Controllers;
    use Models\PetType;
    use DAO\PetTypeDAO;

    class PetTypeController
    {
        private $petTypeDAO;

        public function __construct()
        {
            $this->petTypeDAO = new PetTypeDAO();
        }
        
        public function add($name)
        {
            $petType = new PetType();
            $petType->setName($name);
            $this->petTypeDAO->add($petType);
            $this->showAddView();
        }

        public function showAddView()
        {
            require_once(VIEWS_PATH."add-pet-type.php");
        }

        public function remove($id)
        {
            $this->petTypeDAO->delete($id);

            $this->showListView();
        }

        public function getById($id)
        {
            return $this->petTypeDAO->getById($id);
        }
        
        public function getAll()
        {
            return $this->petTypeDAO->getAll();            
        }
    }
?>