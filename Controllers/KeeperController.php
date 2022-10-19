<?php 

	namespace Controllers;
	use Models\Keeper;
	use Models\User;

	class KeeperController
	{
		private $keeperDAO;

		public function __construct()
		{
			$this->keeperDAO= new keeperDAO();
		}

		public function add($sizePet, $initialDate, $endDate, $price)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$Keeper = new Keeper();
			$Keeper->setUserId($_SESSION['loggedUser']->getId());
			$Keeper->setSizePet($sizePet);
			$Keeper->setInitialDate($initialDate);
			$Keeper->setEndDate($endDate);
			$Keeper->setPrice($price);

			//Validaciones...

			$this->keeperDAO->add($Keeper);
			$this->showPanelView();

		}
		public function showPanelView()
		{
			require_once(VIEWS_PATH . "validate-session.php");
			//require_once(VIEWS_PATH . "main-panel-keeper") o algo asi
		}
		public function showAddView()
		{

		}
		public function showListView()
		{

		}
	}


 ?>