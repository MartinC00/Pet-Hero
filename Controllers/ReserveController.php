<?php 
	namespace Controllers;

    use DateTime;
    use Models\Reserve;
	use Models\User;
	use Models\Keeper;
	use Models\Pet;
	//use DAO\ReserveDAO; not exits yet
	use Controllers\PetController;
	use Controllers\KeeperController;
	use Controllers\UserController;
	use DAO\KeeperDAO;
	use DAO\UserDAO;
	use DAO\PetDAO;

	class ReserveController
	{
		//private $reserveDAO;
		private $petController;
		private $keeperController;
		private $userController;

		public function __construct()
		{
			//$this->reserveDAO = new ReserveDAO();
			$this->petController = new PetController();
			$this->userController = new UserController();
			$this->keeperController = new KeeperController();
		}

		public function add($idKeeper, $idPets, $startDate, $endDate, $totalPrice)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $reserve = new Reserve();

            $reserve->setIdUserOwner($_SESSION["loggedUser"]->getId());
            $reserve->setIdKeeper($idKeeper);
            $reserve->setIdPets($idPets); // CHECK ID PETS EXISTS (se puede tocar desde el codigo fuente el form y mandar cualquier id)
            $reserve->setInitialDate($startDate);
            $reserve->setEndDate($endDate);
            $reserve->setTotalPrice($totalPrice);
        }

		public function remove($reserveId)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$message=$this->reserveDAO->delete($reserveId);
			$this->showReserveList($message);
		}

		public function showAddView($idPets, $startDate, $endDate, $idKeeper, $price)
		{
			require_once(VIEWS_PATH . "validate-session.php");
            $petList = array();
            foreach ($idPets as $petId) {
                $pet = $this->petController->petDAO->getById($petId);
                array_push($petList, $pet);
            }
            $totalPrice = $this->calculateTotalPrice(count($idPets), $startDate, $endDate, $price);
			require_once(VIEWS_PATH . "add-reserve.php");
		}
		
		public function showReserveList($message='')
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$reserveList=$this->reserveDAO->getAll();
			//filtrado para owner y para keeper, mostrarles sus reservas
			require_once(VIEWS_PATH . "reserve-list.php");
		}

        public function showPreReserve($keeperId, $message = "") {
            require_once(VIEWS_PATH . "validate-session.php");
            $userPetList = $this->petController->petDAO->getListByUserId($_SESSION["loggedUser"]->getId());
            $keeper = $this->keeperController->keeperDAO->getById($keeperId);
            $user = $this->userController->UserDAO->getById($keeper->getUserId());
            require_once(VIEWS_PATH . "pre-reserve.php");
        }

		public function modifyReseve()
		{


		}

        private function calculateTotalPrice($numberOfPets, $startDate, $endDate, $price) {
            $date1 = DateTime::createFromFormat("Y-m-d", $startDate);
            $date2 = DateTime::createFromFormat("Y-m-d", $endDate);
            $interval = $date1->diff($date2);
            return $numberOfPets * $price * $interval->days;
        }
	}
 ?>