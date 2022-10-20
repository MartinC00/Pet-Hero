<?php 

	namespace Controllers;

	use Models\Pet;	
	use Models\ePetType as ePetType;
	use DAO\PetDAO;	

	class PetController
	{
		private $PetDAO;

		public function __construct()
		{
			$this->PetDAO = new PetDAO();
		}

		public function addPet ($name, $breed, $size, $photo, $vaccines, $description, $ownerId)
		{
			$pet = new Pet();

			$pet->setName($name);
			$pet->setBreed($breed);
			$pet->setPhoto($photo);
			$pet->setSize($size);
			$pet->setVaccines($vaccines);
			$pet->setDescription($description);
			//$pet->setOwnerId($ownerId);
			$check = $this->checkPet($pet);

			if($check==1) { $this->showAddView("You already added this pet, please add another one"); }

			else
			{
				$this->PetDAO->add($pet);
				$this->showAddView();
			}


			
		}
		public function showAddView($message='')
		{
            /*
			if(!isset($_SESSION["loggedUser"])) 
			{
				require_once(VIEWS_PATH . "add-user.php");
			}
			else if ($_SESSION["loggedUser"]->getUserType()== (eUserType::Keeper->name))
			{
				require_once(VIEWS_PATH . "add-keeper.php"); 
			}
			else
			{
				// require_once(VIEWS_PATH . "main-owner-panel") o algo asi
			}
*/ 
            require_once(VIEWS_PATH . "add-pet.php");
		}

		private function checkPet($newPet) {
            $petList = $this->PetDAO->getAll();

            foreach ($petList as $pet) 
            {
                if ($newPet->getName() == $pet->getName() && $newPet->getOwnerId() == $pet->getOwnerId) return 1;
                
            }
            return 0;
        }
		public function showListView()
		{
			//ADAPTAR SEGUN KEEPER U OWNER

			$petList=$this->PetDAO->getAll();
			require_once(VIEWS_PATH . "pets-list.php");
		}
/*
		public function remove(//id o username)
		{
			$this->userDAO->delete(); //Dentro de la DAO uso la funcion delete() para no llamarla tambien remove()

			//adaptar segun usuario...

			$this-> // show algo

		}
*/

	
	


	}

 ?>