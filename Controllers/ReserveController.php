<?php 
	namespace Controllers;

    use DateTime;
    use Models\Reserve;
	use Models\User;
	use Models\Keeper;
	use Models\Pet;
    use Models\eReserveStatus;
    use Models\ePaymentStatus;
	use Controllers\PetController;
	use Controllers\KeeperController;
	use Controllers\UserController;
    use Controllers\MailController;
    use Controllers\CouponController;
	use DAO\ReserveDAO;

	class ReserveController
	{
		private $reserveDAO;
		private $petController;
		private $keeperController;
		private $userController;
        private $mailController;
        private $couponController;
        
		public function __construct() 
        {
			$this->reserveDAO = new ReserveDAO();
			$this->petController = new PetController();
			$this->userController = new UserController();
			$this->keeperController = new KeeperController();
            $this->mailController = new MailController();
            $this->couponController = new CouponController();
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
            $reserve->setReserveStatus(eReserveStatus::Pending);
            $reserve->setPaymentStatus(ePaymentStatus::Unpayed);

            $petTypeId = $this->petController->getById($idPets[0])->getPetType()->getId();
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
            $reserveList = $this->reserveDAO->getReservesByKeeperOwnerId($idKeeper, $_SESSION["loggedUser"]->getId());
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
            $reserveList = $this->reserveDAO->getReservesByKeeperId($idKeeper);

            $reservesFilteredByDate = array();

            foreach ($reserveList as $reserve) {
                if ($reserve->getInitialDate() <= $initialDate && $reserve->getEndDate() >= $endDate)
                    array_push($reservesFilteredByDate, $reserve);
            }

            if ($reservesFilteredByDate) {
                $firstReserve = $reservesFilteredByDate[0];
                $petType = $this->petController->getById($firstReserve->getIdPets()[0])->getPetType();
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

        public function checkKeeperDisponibility($startDate, $endDate, $idKeeper)
        {
			require_once(VIEWS_PATH . "validate-session.php");
            $keeper=$this->keeperController->getById($idKeeper);
            if($startDate < $keeper->getInitialDate() || $endDate > $keeper->getEndDate()) return 1;
            else return 0;
        }

		public function showAddView($startDate, $endDate, $idKeeper, $price, $idPets=array())
		{
            require_once(VIEWS_PATH . "validate-session.php");

            if(!empty($idPets))
            {
                $datesValidation = $this->keeperController->datesCheck($startDate, $endDate);

    			if($datesValidation == 0)
    			{
                    $checkDisponibility = $this->checkKeeperDisponibility($startDate, $endDate, $idKeeper);
                    if($checkDisponibility == 1) $this->showPreReserve($idKeeper, "Selected dates are out of keeper's disponibility");
                    else
                    {                    
                        $petList = array();
                        foreach ($idPets as $petId) {
                            $pet = $this->petController->getById($petId);
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
                            $this->showPreReserve($idKeeper, "Pets should be from the same specie.");
                    }
    			}
                else $this->showPreReserve($idKeeper, $datesValidation);
            }
            else $this->showPreReserve($idKeeper, "You have to select at least 1 pet !!");
		}

        public function showPreReserve($keeperId, $message = "") 
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $userPetList = $this->petController->getListByUserId($_SESSION["loggedUser"]->getId());
            $keeper = $this->keeperController->getById($keeperId);
            $user = $this->userController->getById($keeper->getUserId());
            require_once(VIEWS_PATH . "pre-reserve.php");
        }
        
		private function checkPetSize($petList, $idKeeper) {
            $keeperPetSize = $this->keeperController->getById($idKeeper)->getPetSize();

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


        private function calculateTotalPrice($numberOfPets, $startDate, $endDate, $price) {
            $date1 = DateTime::createFromFormat("Y-m-d", $startDate);
            $date2 = DateTime::createFromFormat("Y-m-d", $endDate);
            $interval = $date1->diff($date2);
            return $numberOfPets * $price * ($interval->days+1);
        }



        public function showReserveList($message = "")
        {
            require_once(VIEWS_PATH . "validate-session.php");

            if($_SESSION["loggedUser"]->getUserType()->getNameType()=="Owner")
            {
                $reserveList = $this->reserveDAO->getReservesForOwner();
                require_once(VIEWS_PATH . "owner-reserve-list.php");
            }
            else 
            {
                $keeper = $this->keeperController->getByUserId($_SESSION["loggedUser"]->getId());

                $reserveList = $this->reserveDAO->getReservesForKeeper($keeper->getKeeperId());
                require_once(VIEWS_PATH . "keeper-reserve-list.php");
            }
        }

		public function modifyStatus($reserveId, $status) {
            require_once(VIEWS_PATH . "validate-session.php");

            $this->reserveDAO->modifyStatus($reserveId, $status);

            if($status == 0) {
                $this->showReserveList("Reserve rejected!");
            } else
            {
                $reserve=$this->reserveDAO->getById($reserveId);
                $owner=$this->userController->getById($reserve->getIdUserOwner());
                $this->mailController->sendEmail($reserveId, $owner->getName(), $owner->getEmail());
                $this->showReserveList("Reserve accepted! Payment coupon sent to the owner.");
            }
		}

        public function payReserveSign($id, $code)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            
            $checkReturn = $this->checkPay($id, $code);

            if(is_bool($checkReturn))
            {
                $this->reserveDAO->modifyPayment($id, ePaymentStatus::Signed);
                $this->showReserveList("Sign Payed!");
            }
            else $this->showReserveList($checkReturn);
        }

        private function checkPay($id, $code)
        {
            $reserve=$this->reserveDAO->getById($id);
            if($reserve)
            {
                $coupon=$this->couponController->getByReserveId($id);
                if($reserve->getReserveStatus()==eReserveStatus::Accepted)
                {
                    if($reserve->getPaymentStatus()== ePaymentStatus::Unpayed)
                    {
                        if($coupon->getCode()==$code)
                        {
                            return true;
                        }
                        else return "Incorrect coupon code! Please check";
                    }
                    else return "Reserve already signed or payed!";
                }
                else return "Reserve isn't accepted yet";
            }
            else return "Incorrect reserve number! Please check";
        }
        
        /*public function showReserveList_DEPRECATED($message='') //previo a implementacion de inner join en el mysql
        {
            require_once(VIEWS_PATH . "validate-session.php");

            if($_SESSION["loggedUser"]->getUserType()->getNameType()=="Owner")
                $reserveList = $this->reserveDAO->getReservesByOwnerId($_SESSION["loggedUser"]->getId());
            else {
                $keeper = $this->keeperController->getByUserId($_SESSION["loggedUser"]->getId());
                $reserveList = $this->reserveDAO->getReservesByKeeperId($keeper->getKeeperId());
            }
            
            $ownerList = array();
            $keeperList = array();
            $userKeeperList = array();
            $petListReserve = array();
            $petListArray = array();

            foreach($reserveList as $reserve)
            {
                $owner = $this->userController->getById($reserve->getIdUserOwner());
                $keeper = $this->keeperController->getById($reserve->getIdKeeper());
                $userKeeper = $this->userController->getById($keeper->getUserId());

                array_push($ownerList, $owner);
                array_push($keeperList, $keeper);
                array_push($userKeeperList, $userKeeper);

                foreach($reserve->getIdPets() as $idPet)
                {
                    array_push($petListReserve, $this->petController->getById($idPet));
                }
                array_push($petListArray, $petListReserve);

                if ($reserve->getReserveStatus() == 0) { $reserve->setReserveStatus("Rejected"); }
                else if ($reserve->getReserveStatus() == 1) { $reserve->setReserveStatus("Accepted"); }
                else { $reserve->setReserveStatus("Pending"); }
            }

            $i = 0;

            if($_SESSION["loggedUser"]->getUserType()->getNameType()=="Owner")
			    require_once(VIEWS_PATH . "owner-reserve-list.php");
            else {
                require_once(VIEWS_PATH . "keeper-reserve-list.php");
            }
		}
        */
	}
 ?>