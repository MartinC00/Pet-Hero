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

			//Validaciones...

			$this->keeperDAO->add($Keeper);
			$this->showHomeView();

		}
		public function showHomeView()
		{
			require_once(VIEWS_PATH . "validate-session.php");
			require_once(VIEWS_PATH . "keeper-home.php");
		}
		public function showAddView()
		{

		}
		public function showListView()
		{

		}
	}


 ?>