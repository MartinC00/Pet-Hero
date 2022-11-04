<?php 
	namespace Controllers;
	
	use Models\Reserve;
	use Models\Pet;
	//use DAO\ReserveDAO; not exits yet
	use Controllers\PetController;
	use DAO\PetDAO;

	class ReserveController
	{
		//private $reserveDAO;
		private $petController;

		public function __construct()
		{
			//$this->reserveDAO= new ReserveDAO();
			$this->petController= new PetController();
		}
		public function add($idKeeper, $idPets, $dates)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$reserve = new Reserve();
			$reserve->setIdOwner($_SESSION["loggedUser"]->getId());
			$reserve->setIdKeeper($idKeeper);
			
			$reserve->setIdPets($idPets); // CHECK ID PETS EXISTS (se puede tocar desde el codigo fuente el form y mandar cualquier id)
			$reserve->setDates($dates); // CHECK DATES IN RANGE (de la disponibilidad que ofrece el keeper)
			$resere->setTotalPrice($this->calculateTotalPrice($idKeeper, $dates));	


		}
		public function calculateTotalPrice($idKeeper, $dates)
		{
			//todavia no se bien como hacerlo pero seria mas o menos...
			
			$keeper = $this->keeperController->getById($idKeeper);
			return count($dates) * $keeper->getPrice();
		}

		public function remove($reserveId)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$message=$this->reserveDAO->delete($reserveId);
			$this->showReserveList($message);

		}
		public function showAddView($keeperId, $message='')
		{
			require_once(VIEWS_PATH . "validate-session.php");
			require_once(VIEWS_PATH . "add-reserve.php");
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