<?php 

	namespace Controllers;

	use Models\Pet as Pet;
	use Models\User as User;
	use DAO\PetDAO as PetDAO;

	class PetController	{
		private $PetDAO;

		public function __construct() {
			$this->PetDAO = new PetDAO();
		}

		public function add ($name, $breed, $size, $description, $photo)	{
			require_once(VIEWS_PATH . "validate-session.php");

			$pet = new Pet();

			$pet->setUserId($_SESSION['loggedUser']->getId());
			$pet->setName($name);
			$pet->setBreed($breed);
			$pet->setSize($size);
			$pet->setDescription($description);
			$pet->setPhoto($photo);



			//$pet->setVaccines($vaccines);
			//$pet->setVideo($video);

			$check = $this->checkPet($pet);

			if($check==1) { $this->showAddView("You can't have 2 pets with the same name, please choose another one"); } //se podria agregar un enum para breed (raza)
			else
			{
				$this->PetDAO->add($pet);
//                $this->uploadImage($pet);
                $petList = $this->PetDAO->getAll();

                $id = $petList[count($petList) - 1]->getId();
                $this->uploadImage($id);
				$this->showAddView();
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

        public function uploadImage($id) {
            require_once(VIEWS_PATH . "validate-session.php");

            //if (isset($_POST['subir'])) {
                //Recogemos el archivo enviado por el formulario
                $archivo = $_FILES['photo']['name'];
                //Si el archivo contiene algo y es diferente de vacio
                if (isset($archivo) && $archivo != "") {
                    //Obtenemos algunos datos necesarios sobre el archivo
                    $tipo = $_FILES['photo']['type'];
                    $tamano = $_FILES['photo']['size'];
                    $temp = $_FILES['photo']['tmp_name'];

                    //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                    if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                        echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                    }
                    else {
//                        Si la imagen es correcta en tamaño y tipo
//                        Se intenta subir al servidor
                        $filename = $_SESSION["loggedUser"]->getUsername()."-". $id. ".jpg";
                        if (move_uploaded_file($temp, $_SERVER["DOCUMENT_ROOT"].IMG_PATH.$filename)) {
                            $pet = $this->PetDAO->getById($id);
                            $pet->setPhoto($filename);
                            $this->PetDAO->modify($pet);



                            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                            //chmod(IMG_PATH.$archivo, 0777);
                            //Mostramos el mensaje de que se ha subido co éxito
                            //echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                            //Mostramos la imagen subida
                            //echo '<p><img src="'.IMG_PATH.$archivo.'"></p>';
                        }
                        else {
                            //Si no se ha podido subir la imagen, mostramos un mensaje de error
                            echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                        }
                    }
                }

            //}
        }
	}

 ?>