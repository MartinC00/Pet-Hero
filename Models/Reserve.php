<?php 

	namespace Models;

	class Reserve
	{
		private $idUserOwner;
		private $idKeeper; //o bien el idUserKeeper
		private $idPets; //array, ojo, CHECK petType (que no se mezclen perros y gatos, pero si muchos perros o muchos gatos)
		private $initialDate;
		private $endDate; 
		private $totalPrice; //count array fechas * keeper.price (per day)
		

	    public function getIdUserOwner()
	    {
	        return $this->idUserOwner;
	    }
		 

	    public function setIdUserOwner($idOwner)
	    {
	        $this->idUserOwner = $idOwner;

	        return $this;
	    }


	    public function getIdKeeper()
	    {
	        return $this->idKeeper;
	    }


	    public function setIdKeeper($idKeeper)
	    {
	        $this->idKeeper = $idKeeper;

	        return $this;
	    }


	    public function getIdPets()
	    {
	        return $this->idPets;
	    }


	    public function setIdPets($idPets)
	    {
	        $this->idPets = $idPets;

	        return $this;
	    }

	    public function getTotalPrice()
	    {
	        return $this->totalPrice;
	    }

	    public function setTotalPrice($totalPrice)
	    {
	        $this->totalPrice = $totalPrice;

	        return $this;
	    }

	    public function getEndDate()
	    {
	        return $this->endDate;
	    }

	    public function setEndDate($endDate)
	    {
	        $this->endDate = $endDate;

	        return $this;
	    }

	    public function getInitialDate()
	    {
	        return $this->initialDate;
	    }

	    public function setInitialDate($initialDate)
	    {
	        $this->initialDate = $initialDate;

	        return $this;
	    }
	}
 ?>