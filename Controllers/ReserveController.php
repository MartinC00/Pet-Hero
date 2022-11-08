<?php 
	namespace Controllers;

    use DateTime;
    use Models\Reserve;
	use Models\User;
	use Models\Keeper;
	use Models\Pet;
    use Models\ReserveStatus;
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

		public function add($initialDate, $endDate, $idKeeper, $idPets, $totalPrice)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $reserve = new Reserve();

            $reserve->setIdUserOwner($_SESSION["loggedUser"]->getId());

            $reserve->setIdKeeper($idKeeper);
            $reserve->setIdPets($idPets); // CHECK ID PETS EXISTS (se puede tocar desde el codigo fuente el form y mandar cualquier id)
            $reserve->setInitialDate($initialDate);
            $reserve->setEndDate($endDate);
            $reserve->setTotalPrice($totalPrice);
            $reserve->setReserveStatus(ReserveStatus::Pending);

            $petTypeId = $this->petController->petDAO->getById($idPets[0])->getPetType()->getId();
            $check=$this->checkReserve($idKeeper, $petTypeId, $initialDate, $endDate);
            if($check)
            {
                $check=$this->checkReserveExists($idPets, $initialDate, $endDate, $idKeeper);
                if(!$check)
                {
                    $this->reserveDAO->add($reserve);
                    $this->userController->showHomeView("Reservation successfully booked! :) pending keeper's confirmation");
                }
                else $this->showPreReserve($idKeeper, "You already have a reservation booked for that pet on those days");
            }
            else $this->showPreReserve($idKeeper, "This Keeper cannot take care of that kind of pet on those days.");
        }

        private function checkReserveExists($idPets, $initialDate, $endDate, $idKeeper)
        {
            $reserveList = $this->reserveDAO->getByKeeperOwnerId($idKeeper, $_SESSION["loggedUser"]->getId());
            $reservesFiltered = array();

            foreach ($reserveList as $reserve) 
            {
                if ($reserve->getInitialDate() <= $initialDate && $reserve->getEndDate() >= $endDate)
                {
                    if(array_intersect($reserve->getIdPets(), $idPets)) return true;
                    /*
                    foreach($reserve->getIdPets() as $idPetReserve)
                    {
                        foreach($idPets as $idPetOwner)
                        {
                            if($idPetOwner == $idPetReserve) return true;
                        }
                    }*/
                }
            }
            return false;
        }

        private function checkReserve($idKeeper, $idPetType, $initialDate, $endDate)
        {
            $reserveList = $this->reserveDAO->getReservesByKeeper($idKeeper);

            $reservesFilteredByDate = array();

            foreach ($reserveList as $reserve) {
                if ($reserve->getInitialDate() <= $initialDate && $reserve->getEndDate() >= $endDate)
                    array_push($reservesFilteredByDate, $reserve);
            }

            if ($reservesFilteredByDate) {
                $firstReserve = $reservesFilteredByDate[0];
                $petType = $this->petController->petDAO->getById($firstReserve->getIdPets()[0])->getPetType();
                if ($petType->getId() != $idPetType) return false;                   
                
            }
            return true;
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

                foreach ($idPets as $petId) {
                    $pet = $this->petController->petDAO->getById($petId);
                    array_push($petList, $pet);
                }

                if($this->checkPetType($petList, $idKeeper)) {
                    if ($this->checkPetSize($petList, $idKeeper)) {
                        $totalPrice = $this->calculateTotalPrice(count($idPets), $startDate, $endDate, $price);
                        require_once(VIEWS_PATH . "add-reserve.php");
                    } else
                        $this->showPreReserve($idKeeper, "Please select pets that have a matching size with Keeper size");
                }
                else
                    $this->showPreReserve($idKeeper, "Pets should be from same pet-type");
			}
		}

		private function checkPetSize($petList, $idKeeper) {
            $keeperPetSize = $this->keeperController->keeperDAO->getById($idKeeper)->getPetSize();

            foreach ($petList as $pet) {
                if($pet->getSize() != $keeperPetSize)
                    return false;
            }
            return true;
        }

        private function checkPetType($petList) {

            $petType = $petList[0]->getPetType();

            foreach($petList as $pet) {
                if ($pet->getPetType() != $petType)
                    return false;
            }
            return true;
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
            return $numberOfPets * $price * ($interval->days+1);
        }

        public function showReserveList($idKeeper=null, $message='')
		{
			require_once(VIEWS_PATH . "validate-session.php");
            
            if($idKeeper) $reserveList=$this->reserveDAO->getReservesByKeeper($idKeeper);
                else $reserveList = $this->reserveDAO->getByOwnerId($_SESSION["loggedUser"]->getId());
                
			require_once(VIEWS_PATH . "reserve-list.php");
		}

		public function modifyReseve()
		{


		}
	}
 ?>