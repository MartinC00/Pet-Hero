<?php 

	namespace Controllers;
	use Models\Keeper;
	use Models\User;
	use DAO\KeeperDAO;
	use DAO\UserDAO;

	class KeeperController
	{
		private $keeperDAO;
		private $userDAO;

		public function __construct()
		{
			$this->keeperDAO= new KeeperDAO();
			$this->userDAO= new UserDAO();
		}

		public function add($address, $petSize, $initialDate, $endDate, $price)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$Keeper = new Keeper();
			$Keeper->setAddress($address);
			$Keeper->setUserId($_SESSION['loggedUser']->getId());
			$Keeper->setPetSize($petSize);
			$Keeper->setInitialDate($initialDate);
			$Keeper->setEndDate($endDate);
			$Keeper->setPrice($price);

			$check = $this->datesCheck($initialDate, $endDate);

			if($check == 1) { $this->showAddView("Initial Date must be previous to End Date"); }
			else if ($check == 2) { $this->showAddView("Initial Date mustn't be previous to current date"); }
			else
			{			
				$this->keeperDAO->add($Keeper);
				$this->showHomeView();
			}

		}
		public function showAddView($message='')
		{
			require_once(VIEWS_PATH . "validate-session.php");
			require_once(VIEWS_PATH . "add-keeper.php");
		}
		public function datesCheck($initialDate, $endDate)
		{
			$currentDate = strtotime(date("d-m-Y",time()));

			$initialDateUnix = strtotime($initialDate);
			$endDateUnix = strtotime($endDate);

			if($initialDateUnix > $endDateUnix) return 1;
			else if($initialDateUnix < $currentDate) return 2;
			else return 0;

		}
		public function showHomeView()
		{
			require_once(VIEWS_PATH . "validate-session.php");
			require_once(VIEWS_PATH . "keeper-home.php");
		}

		public function showListView()
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$keeperList=$this->keeperDAO->getAll();
			require_once(VIEWS_PATH . "keeper-list.php");

		}

		public function getKeeperLogged()
		{
			require_once(VIEWS_PATH . "validate-session.php");
			
			$keeper= $this->keeperDAO->getById($_SESSION["loggedUser"]->getId());

			return $keeper;
		}

		public function modifyProfile($address, $petSize, $initialDate, $endDate, $price)
		{			
			$keeper= $this->getKeeperLogged();

			$keeper->setAddress($address);
			$keeper->setPetSize($petSize);

			$keeper->setInitialDate($initialDate);
			$keeper->setEndDate($endDate);
			$keeper->setPrice($price);

			$check = $this->datesCheck($initialDate, $endDate);

			if($check == 1) { $this->showModifyKeeperProfile("Initial Date must be previous to End Date"); }
			else if ($check == 2) { $this->showModifyKeeperProfile("Initial Date mustn't be previous to current date"); }
			else
			{
				$this->keeperDAO->modify($keeper);
				$this->showHomeView();
			}
		}

		public function showKeeperProfile()
		{
			$keeper= $this->getKeeperLogged();
			require_once(VIEWS_PATH . "keeper-profile.php");
		}

		public function showModifyKeeperProfile($message="")
		{
			$keeper= $this->getKeeperLogged();
        	require_once(VIEWS_PATH . "modify-keeper-profile.php");
		}




	}

 ?>