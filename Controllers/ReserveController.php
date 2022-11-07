<?php 
	namespace Controllers;

    use DateTime;
    use Models\Reserve;
	use Models\User;
	use Models\Keeper;
	use Models\Pet;
	use Controllers\PetController;
	use Controllers\KeeperController;
	use Controllers\UserController;
	use DAO\UserDAO;
	use DAO\KeeperDAO;
	use DAO\PetDAO;
	use DAO\ReserveDAO;

	class ReserveController
	{
		private $reserveDAO;
		private $petController;
		private $keeperController;
		private $userController;

		public function __construct()
		{
			$this->reserveDAO = new ReserveDAO();
			$this->petController = new PetController();
			$this->userController = new UserController();
			$this->keeperController = new KeeperController();
		}

		public function add($startDate, $endDate, $idKeeper, $idPets, $totalPrice)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $reserve = new Reserve();

            $reserve->setIdUserOwner($_SESSION["loggedUser"]->getId());
            $reserve->setIdKeeper($idKeeper);
            $reserve->setIdPets($idPets); // CHECK ID PETS EXISTS (se puede tocar desde el codigo fuente el form y mandar cualquier id)
            $reserve->setInitialDate($startDate);
            $reserve->setEndDate($endDate);
            $reserve->setTotalPrice($totalPrice);


            $this->reserveDAO->add($reserve);
            $this->userController->showHomeView("Reservation successfully booked! :) pending keeper's confirmation")
        }

        public function checkReserve($idKeeper, $idPetType, $initialDate, $endDate)
        {
        	$reservesList = $this->reserveDAO->getAll();
        	$keeperReservesList=array();

        	foreach($reserveList as $reserve)
        	{
        		if($reserve->getKeeperId()==$idKeeper)
        		{
        			array_push($keeperReservesList, $reserve); //lista de reservas de ESE keeper
        		}
        	}

        	$reserveListDateFilter = array();
        	foreach($keeperReservesList as $reserve)
        	{
        		if($reserve->getInitialDate() <= $initialDate && $reserve->getEndDate >= $endDate) 
        			array_push($reserveListDateFilter, $reserve);
        	}

        	$reserveListPetTypeFilter = array();
        	foreach($reserveListDateFilter as $reserve)
        	{
        		$petType = $this->petController->petDAO->getById($reserve->getIdPets()[0])->getPetType();
        		if($petType->getId() == $idPetType)
        			array_push($reserveListPetTypeFilter, $reserve);
        	}

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
            $check = $this->keeperController->datesCheck($startDate, $endDate);

            if($check == 1) { $this->showPreReserve($idKeeper, "Initial Date must be previous to End Date"); }
			else if ($check == 2) { $this->showPreReserve($idKeeper, "Initial Date mustn't be previous to current date"); }
			else
			{
	            $petList = array();
	            foreach ($idPets as $petId) 
	            {
	                $pet = $this->petController->petDAO->getById($petId);
	                array_push($petList, $pet);
	            }

	            $flag=true;
	            $petType = $petList[0]->getPetType();
	            foreach($petList as $pet)
	            {
	            	if($pet->getPetType()!=$petType) $flag=false;
	            }

	            if($flag)
	            {
		            $totalPrice = $this->calculateTotalPrice(count($idPets), $startDate, $endDate, $price);
					require_once(VIEWS_PATH . "add-reserve.php");
	            }
	            else
	            {
	            	$this->showPreReserve($idKeeper, "Pets should be from same pet-type");
	            }
			}
		}
		

        public function showPreReserve($keeperId, $message = "") 
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $userPetList = $this->petController->petDAO->getListByUserId($_SESSION["loggedUser"]->getId());
            $keeper = $this->keeperController->keeperDAO->getById($keeperId);
            $user = $this->userController->UserDAO->getById($keeper->getUserId());
            require_once(VIEWS_PATH . "pre-reserve.php");
        }

        private function calculateTotalPrice($numberOfPets, $startDate, $endDate, $price) {
            $date1 = DateTime::createFromFormat("Y-m-d", $startDate);
            $date2 = DateTime::createFromFormat("Y-m-d", $endDate);
            $interval = $date1->diff($date2);
            return $numberOfPets * $price * $interval->days;
        }


        public function showReserveList($message='')
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$reserveList=$this->reserveDAO->getAll();
			//filtrado para owner y para keeper, mostrarles sus reservas
			require_once(VIEWS_PATH . "reserve-list.php");
		}


		public function modifyReseve()
		{


		}
	}
 ?>