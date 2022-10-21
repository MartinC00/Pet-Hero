<?php 

	namespace Controllers;
	use Models\Keeper;
	use Models\User;
	use DAO\KeeperDAO;

	class KeeperController
	{
		private $keeperDAO;

		public function __construct()
		{
			$this->keeperDAO= new keeperDAO();
		}

		public function add($petSize, $initialDate, $endDate, $price)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$Keeper = new Keeper();
			$Keeper->setUserId($_SESSION['loggedUser']->getId());
			$Keeper->setPetSize($petSize);
			$Keeper->setInitialDate($initialDate);
			$Keeper->setEndDate($endDate);
			$Keeper->setPrice($price);

			$check = $this->datesCheck($initialDate, $endDate);
			if($check == 1) { $this->showAddView("Initial Date must be previous to End Date"); }
			else if ($check == 2) { $this->showAddView("Initial Date and End Date mustn't be previous to current date"); }
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
			$currentDate = strtotime(date("d-m-Y H:i:00",time()));

			$initialDateUnix = strtotime($initialDate);
			$endDateUnix = strtotime($endDate);

			if($initialDateUnix > $endDateUnix) return 1;
			else if($initialDateUnix < $currentDate || $EndDateUnix < $currentDate) return 2;
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
			$keeper = new Keeper();
			$keeper= $this->KeeperDAO->getById($_SESSION["loggedUser"]->getId());
			return $keeper;
		}

		public function modifyProfile($petSize, $initialDate, $endDate, $price)
		{			
			$keeper = new Keeper();
			$keeper= $this->getKeeperLogged();

			$keeper->setPetSize($petSize);
			//VALIDACIONES PARA FECHAS !!
			$keeper->setInitialDate($initialDate);
			$keeper->setEndDate($endDate);
			$user->setPrice($price);
			
			$this->KeeperDAO->modify($keeper);
			$this->showHomeView();
		}

		public function showKeeperProfile()
		{
			$keeper = new Keeper();
			$keeper= $this->getKeeperLogged();

			require_once(VIEWS_PATH . "keeper-profile.php");
		}

		public function showModifyKeeperProfile()
		{
        	$keeper = new Keeper();
			$keeper= $this->getKeeperLogged();
        	require_once(VIEWS_PATH . "modify-user-profile.php");
		}




	}

 ?>