<?php 

	namespace Controllers;
	use Models\Keeper;
	use Models\User;
	use Controllers\UserController;
	use DAO\KeeperDAO;
	use DAO\UserDAO;


	class KeeperController
	{
		public $keeperDAO;
		private $userController;

		public function __construct()
		{
			$this->keeperDAO= new KeeperDAO();
			$this->userController= new UserController();
		}

		public function add($addressStreet, $addressNumber, $petSize, $initialDate, $endDate, $days, $price)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$Keeper = new Keeper();
			$Keeper->setUserId($_SESSION['loggedUser']->getId());
			$Keeper->setAddressStreet($addressStreet);
			$Keeper->setAddressNumber($addressNumber);
			$Keeper->setPetSize($petSize);
			$Keeper->setInitialDate($initialDate);
			$Keeper->setEndDate($endDate);
			$Keeper->setDays($days);
			$Keeper->setPrice($price);

			$check = $this->datesCheck($initialDate, $endDate);

			if($check == 1) { $this->showAddView("Initial Date must be previous to End Date"); }
			else if ($check == 2) { $this->showAddView("Initial Date mustn't be previous to current date"); }
			else
			{			
				$response=$this->keeperDAO->add($Keeper);
				$this->showHomeView($response);
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
		public function showHomeView($message='')
		{
			require_once(VIEWS_PATH . "validate-session.php");
			require_once(VIEWS_PATH . "keeper-home.php");
		}

		public function showListView()
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$message=''; $message1='';$initialDate=''; $endDate='';
			$keeperList=$this->keeperDAO->getAll();
			require_once(VIEWS_PATH . "keeper-list.php");
		}
		public function showFilterListView($initialDate, $endDate) //listado filtrado por fechas que ingreso el usuario
		{
			require_once(VIEWS_PATH . "validate-session.php");
			
			$check = $this->datesCheck($initialDate, $endDate);

			if($check == 1) { $message1="Initial Date must be previous to End Date"; $this->showListView(); }
			else if ($check == 2) { $message1="Initial Date mustn't be previous to current date"; $this->showListView();}
			else
			{			
				$keeperList=$this->keeperDAO->getAll();
				$keeperListFiltered = array();

				foreach ($keeperList as $keeper)
				{
					if($keeper->getInitialDate() <= $initialDate && $endDate <= $keeper->getEndDate())
					{
						array_push($keeperListFiltered, $keeper);
					}
				}

				$keeperList=$keeperListFiltered;
				if(empty($keeperList)) $message="Oh, seems like there's not keepers availables in that range of dates... Try another dates";
			}
			require_once(VIEWS_PATH . "keeper-list.php");
		}


		public function getKeeperLogged()
		{
			require_once(VIEWS_PATH . "validate-session.php");
			
			$keeper= $this->keeperDAO->getByUserId($_SESSION["loggedUser"]->getId());

			return $keeper;
		}

		public function modifyProfile($addressStreet,$addressNumber, $petSize, $initialDate, $endDate,$days, $price)
		{			
			$keeper= $this->getKeeperLogged();

			$keeper->setAddressStreet($addressStreet);
			$keeper->setAddressNumber($addressNumber);
			$keeper->setPetSize($petSize);
			$keeper->setInitialDate($initialDate);
			$keeper->setEndDate($endDate);
			$keeper->setDays($days);
			$keeper->setPrice($price);

			$check = $this->datesCheck($initialDate, $endDate);

			if($check == 1) { $this->showModifyKeeperProfile("Initial Date must be previous to End Date"); }
			else if ($check == 2) { $this->showModifyKeeperProfile("Initial Date mustn't be previous to current date"); }
			else
			{
				$this->keeperDAO->modify($keeper);
				$this->showHomeView("Keeper data modified !");
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