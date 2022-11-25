<?php 

	namespace Controllers;

	use Models\Pet;
    use Models\PetType;
    use Controllers\PetTypeController;
	use DAO\PetDAO;

	class PetController	
    {
		private $petDAO;
        private $petTypeController;

		public function __construct() 
        {
			$this->petDAO = new PetDAO();
            $this->petTypeController = new PetTypeController();
		}

		public function add ($name, $petTypeId, $breed, $size, $description, $photo, $vaccines, $video) 
        {
			require_once(VIEWS_PATH . "validate-session.php");

            $petType = $this->petTypeController->getById($petTypeId);

            if($petType)
            {                
    			$pet = new Pet();
                $petType = new PetType();
                $petType->setId($petTypeId);
                $pet->setPetType($petType);
    			$pet->setUserId($_SESSION['loggedUser']->getId());
                $pet->setName($name);
    			$pet->setBreed($breed);
    			$pet->setSize($size);
    			$pet->setDescription($description);
    			$pet->setIsActive(true);

    			$check = $this->checkPet($pet);

    			if($check==1) { $this->showAddView("You can't have 2 pets with the same name, please choose another one"); } 
    			else 
                {
    				$id=$this->petDAO->add($pet);

                    $this->uploadPhoto($id);
                    $this->uploadVaccines($id);
                    $this->uploadVideo($id);
    				$this->showAddView("Nueva mascota registrada !");
                }
			}
            else $this->showAddView("Please set correctly the pet type and stop manipulating html code :) ");
                
		}

		public function showAddView($message = "") 
        {
			require_once(VIEWS_PATH . "validate-session.php");
            $petTypeList = $this->petTypeController->getAll();
            require_once(VIEWS_PATH . "add-pet.php");
		}

		private function checkPet($newPet) {
            $petList = $this->petDAO->getAll();
            foreach ($petList as $pet) 
            {
                if ($newPet->getName() == $pet->getName() && $newPet->getUserId()==$pet->getUserId()) return 1; //Esta verificacion implica que se tiene que repetir el nombre en la lista de mascotas y ademas que esa mascosta este asociada al mismo usuario que esta creando esta nueva. Un usuario no puede registrar dos mascotas que se llamen igual, pero distintos usuarios pueden tener mascotas que se llamen igual
            }
            return 0;
        }

        public function getById($id)
        {
            return $this->petDAO->getById($id);
        }
        
        public function getListByUserId($id)
        {
            return $this->petDAO->getListByUserId($id);
        }

		public function showPetsList($message="") 
        {
			require_once(VIEWS_PATH . "validate-session.php");
            $userPetsList = $this->petDAO->getListByUserId($_SESSION["loggedUser"]->getId());
            require_once(VIEWS_PATH . "pets-list.php");
		}

        public function uploadPhoto($idPet) {
            require_once(VIEWS_PATH . "validate-session.php");

            $archivo = $_FILES['photo']['name']; //Levantamos el archivo enviado por el formulario

            if (isset($archivo) && $archivo != "") { //Si el archivo contiene algo y es diferente de vacio
                $tipo = $_FILES['photo']['type'];
                $tamano = $_FILES['photo']['size']; //Obtenemos algunos datos necesarios sobre el archivo
                $temp = $_FILES['photo']['tmp_name'];

                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 6000000))) 
                {
                    return "Error. El video debe ser JPG/PNG/JPEG/GIF y no pesar mas de 5 MB";
                }
                else 
                { // Si la imagen es correcta en tamaño y tipo Se intenta subir al servidor
                    $filename = $_SESSION["loggedUser"]->getUsername()."-". $idPet. ".jpg";
                    if (move_uploaded_file($temp, $_SERVER["DOCUMENT_ROOT"].IMG_PATH.$filename)) {
                        $pet = $this->petDAO->getById($idPet);
                        $pet->setPhoto($filename);
                        $response=$this->petDAO->modify($pet);
                    }
                    else 
                        return "Ocurrió algún error al subir la foto. No pudo guardarse";      
                }         

            }
        }

        public function uploadVaccines($id) {
            require_once(VIEWS_PATH . "validate-session.php");

            $archivo = $_FILES['vaccines']['name']; //Levantamos el archivo enviado por el formulario

            if (isset($archivo) && $archivo != "") { //Si el archivo contiene algo y es diferente de vacio
                $tipo = $_FILES['vaccines']['type'];
                $tamano = $_FILES['vaccines']['size']; //Obtenemos algunos datos necesarios sobre el archivo
                $temp = $_FILES['vaccines']['tmp_name'];

                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 6000000))) {
                    return "Error. El video debe ser JPG/PNG/JPEG/GIF y no pesar mas de 5 MB";
                } else { // Si la imagen es correcta en tamaño y tipo Se intenta subir al servidor
                    $filename = $_SESSION["loggedUser"]->getUsername()."-v". $id . ".jpg";
                    if (move_uploaded_file($temp, $_SERVER["DOCUMENT_ROOT"].IMG_PATH.$filename)) {
                        
                        $pet = $this->petDAO->getById($id);
                        $pet->setVaccines($filename);
                        $response=$this->petDAO->modify($pet);     
                    }
                    else //Si no se ha podido subir la imagen, mostramos un mensaje de error
                        return "Ocurrió algún error al subir el calendario de vacunacion. No pudo guardarse";
                }
            }
        }

        public function uploadVideo($id) 
        {
            require_once(VIEWS_PATH . "validate-session.php");

            $archivo = $_FILES['video']['name'];

            if (isset($archivo) && $archivo != "") { //Si el archivo contiene algo y es diferente de vacio
                $tipo = $_FILES['video']['type'];
                $tamano = $_FILES['video']['size']; //Obtenemos algunos datos necesarios sobre el archivo
                $temp = $_FILES['video']['tmp_name'];

                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "mp4")) && ($tamano < 6000000))) {
                    return "Error. El video debe ser MP4 y no pesar mas de 20 MB";
                } else { // Si el video es correcta en tamaño y tipo Se intenta subir al servidor
                    $filename = $_SESSION["loggedUser"]->getUsername()."-video". $id . ".mp4";
                    if (move_uploaded_file($temp, $_SERVER["DOCUMENT_ROOT"].IMG_PATH.$filename)) {
                        $pet = $this->petDAO->getById($id);
                        $pet->setVideo($filename);
                        $response=$this->petDAO->modify($pet);  
                    }
                    else //Si no se ha podido subir el video, mostramos un mensaje de error
                        return "Ocurrió algún error al subir el video. No pudo guardarse";
                }
            }
        }

        public function showModifyPetView($id)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $pet = $this->petDAO->getById($id);
            require_once(VIEWS_PATH . "modify-pet-profile.php");
        }

        public function checkPetName($newName)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $petList = $this->petDAO->getListByUserId($_SESSION["loggedUser"]->getId());

            foreach ($petList as $pet) 
            {
                if ($newName == $pet->getName()) return 1; 
            }
            return 0;
        }

        public function modifyPet($name, $description, $id, $photo, $vaccines, $video)
        {
            require_once(VIEWS_PATH . "validate-session.php");

            $pet = $this->petDAO->getById($id);
            
            if($pet)
            {       
                if($pet->getName()!=$name)
                {
                    $check = $this->checkPetName($name);
                    
                    if($check==1)  $this->showModifyPetView("You can't have 2 pets with the same name, please choose another one"); 
                    else $pet->setName($name);    
                }

                if($pet->getDescription()!=$description) $pet->setDescription($description);
                
                $this->petDAO->modify($pet);
                
                $this->uploadPhoto($id);
                $this->uploadVaccines($id);
                $this->uploadVideo($id);                        
                    
                $this->showPetsList("Modified Pet!");
                
            }
            else $this->showPetsList("Please don't touch the pet id -.-' ");
        }

        public function remove($id)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $this->petDAO->delete($id);
            $this->showPetsList("Pet deleted");
        }
	}
 ?>