<?php
    namespace Controllers;
    use Models\PetType;
    use DAO\PetTypeDAO;

    class PetTypeController
    {
        public $petTypeDAO;

        public function add($name)
        {
            $petType = new PetType();
            $petType->setName($name);
            $this->petTypeDAO->add($petType);
            $this->showAddView();
        }

        public function __construct()
        {
            $this->petTypeDAO = new PetTypeDAO();
        }

        public function showAddView()
        {
            require_once(VIEWS_PATH."add-pet-type.php");
        }

        public function showListView()
        {
            $petTypeList = $this->beerTypeDAO->GetAll();
            require_once(VIEWS_PATH."pet-type-list.php");
        }

        public function remove($id)
        {
            $this->petTypeDAO->delete($id);

            $this->showListView();
        }
    }
?>