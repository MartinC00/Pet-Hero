<?php 

	namespace Controllers;

	use Models\Pet as Pet;
	use DAO\PetDAO as PetDAO;

	class PetController	{
		private $PetDAO;

		public function __construct() {
			$this->PetDAO = new PetDAO();
		}

		public function add ($name, $breed, $size, $description, $photo, $vaccines, $video) {
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
			else {
				$response=$this->PetDAO->add($pet);
                $petList = $this->PetDAO->getAll();

                $id = $petList[count($petList) - 1]->getId();
                $this->uploadPhoto($id);
                $this->uploadVaccines($id);
                $this->uploadVideo($id);
				$this->showAddView($response);
			}
			
		}

		public function showAddView($message = "") {
			require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "add-pet.php");
		}

		private function checkPet($newPet) {
            $petList = $this->PetDAO->getAll();

            foreach ($petList as $pet) 
            {
                if ($newPet->getName() == $pet->getName() && $newPet->getUserId()==$pet->getUserId()) return 1; //Esta verificacion implica que se tiene que repetir el nombre en la lista de mascotas y ademas que esa mascosta este asociada al mismo usuario que esta creando esta nueva. Un usuario no puede registrar dos mascotas que se llamen igual, pero distintos usuarios pueden tener mascotas que se llamen igual
            }

            return 0;
        }

		public function showMyPets() {
			require_once(VIEWS_PATH . "validate-session.php");
			$userPetsList = $this->PetDAO->getListById($_SESSION["loggedUser"]->getId());
			require_once(VIEWS_PATH . "see-my-pets.php");
		}

		public function remove($id) {
			$this->PetDAO->delete($id);
			$this->showMyPets();

		}

        public function uploadPhoto($id) {
            require_once(VIEWS_PATH . "validate-session.php");

            $archivo = $_FILES['photo']['name']; //Levantamos el archivo enviado por el formulario

            if (isset($archivo) && $archivo != "") { //Si el archivo contiene algo y es diferente de vacio
                $tipo = $_FILES['photo']['type'];
                $tamano = $_FILES['photo']['size']; //Obtenemos algunos datos necesarios sobre el archivo
                $temp = $_FILES['photo']['tmp_name'];

                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                    - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                } else { // Si la imagen es correcta en tamaño y tipo Se intenta subir al servidor
                    $filename = $_SESSION["loggedUser"]->getUsername()."-". $id. ".jpg";
                    if (move_uploaded_file($temp, $_SERVER["DOCUMENT_ROOT"].IMG_PATH.$filename)) {
                        $pet = $this->PetDAO->getById($id);
                        $pet->setPhoto($filename);
                        $this->PetDAO->modify($pet);
                    }
                    else //Si no se ha podido subir la imagen, mostramos un mensaje de error
                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
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
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                    - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                } else { // Si la imagen es correcta en tamaño y tipo Se intenta subir al servidor
                    $filename = $_SESSION["loggedUser"]->getUsername()."-v". $id . ".jpg";
                    if (move_uploaded_file($temp, $_SERVER["DOCUMENT_ROOT"].IMG_PATH.$filename)) {
                        $pet = $this->PetDAO->getById($id);
                        $pet->setVaccines($filename);
                        $this->PetDAO->modify($pet);
                    }
                    else //Si no se ha podido subir la imagen, mostramos un mensaje de error
                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                }
            }
        }

        public function uploadVideo($id) {
            require_once(VIEWS_PATH . "validate-session.php");

            $archivo = $_FILES['video']['name'];

            if (isset($archivo) && $archivo != "") { //Si el archivo contiene algo y es diferente de vacio
                $tipo = $_FILES['video']['type'];
                $tamano = $_FILES['video']['size']; //Obtenemos algunos datos necesarios sobre el archivo
                $temp = $_FILES['video']['tmp_name'];

                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "mp4")) && ($tamano < 200000000))) {
                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                    - Se permiten archivos .gif, .jpg, .png. y de 20 mb como máximo.</b></div>';
                } else { // Si el video es correcta en tamaño y tipo Se intenta subir al servidor
                    $filename = $_SESSION["loggedUser"]->getUsername()."-video". $id . ".mp4";
                    if (move_uploaded_file($temp, $_SERVER["DOCUMENT_ROOT"].IMG_PATH.$filename)) {
                        $pet = $this->PetDAO->getById($id);
                        $pet->setVideo($filename);
                        $this->PetDAO->modify($pet);
                    }
                    else //Si no se ha podido subir el video, mostramos un mensaje de error
                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                }
            }
        }
	}
 ?>