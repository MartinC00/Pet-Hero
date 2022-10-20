<?php 

	namespace Controllers;

	use Models\Pet;	
	use Models\User;	
	use DAO\PetDAO;	

	class PetController
	{
		private $PetDAO;

		public function __construct()
		{
			$this->PetDAO = new PetDAO();
		}

		public function addPet ($name, $breed, $size, $description, $photo, $vaccines, $video)
		{
			require_once(VIEWS_PATH . "validate-session.php");

			$pet = new Pet();

			$pet->setUserId($_SESSION['loggedUser']->getId());
			$pet->setName($name);
			$pet->setBreed($breed);
			$pet->setSize($size);
			$pet->setDescription($description);
			$pet->setPhoto($photo);
			$pet->setVaccines($vaccines);
			$pet->setVideo($video);

			$check = $this->checkPet($pet);

			if($check==1) { $this->showAddView("You can't have 2 pets with the same name, please choose another one"); } //se podria agregar un enum para breed (raza)
			else
			{
				$this->PetDAO->add($pet);
				$this->showAddView();
			}
			
		}
		public function showAddView($message='')
		{
			require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "add-pet.php");
		}

		private function checkPet($newPet) 
		{
            $petList = $this->PetDAO->getAll();

            foreach ($petList as $pet) 
            {
                if ($newPet->getName() == $pet->getName() && $newPet->getUserId()==$pet->getUserId()) return 1; //Esta verificacion implica que se tiene que repetir el nombre en la lista de mascotas y ademas que esa mascosta este asociada al mismo usuario que esta creando esta nueva. Un usuario no puede registrar dos mascotas que se llamen igual, pero distintos usuarios pueden tener mascotas que se llamen igual
            }

            return 0;
        }
		public function showUserPets()
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$userPetsList = $this->PetDAO->getListById($_SESSION["loggedUser"]->getId());
			require_once(VIEWS_PATH . "see-my-pets.php");
		}

		public function remove($id)
		{
			$this->userDAO->delete($id);
			$this->showListView();

		}

		public function showAddPet()
		{
			require_once(VIEWS_PATH . "validate-session.php");
			require_once(VIEWS_PATH . "add-pet.php");
		}


	
	


	}

 ?>