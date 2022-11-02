<?php 

	namespace Models;

	class Reserve
	{
		private $idOwner; //user owner
		private $idKeeper; //o bien el idUserKeeper
		private $idPets; //array, ojo, CHECK petType (que no se mezclen perros y gatos, pero si muchos perros o muchos gatos)
		private $dates; //array de fechas? multiple date existe en form html?, check en controller dates in range disponibilidad de keeper
		private $totalPrice; //count array fechas * keeper.price (per day)


	    public function getIdOwner()
	    {
	        return $this->idOwner;
	    }


	    public function setIdOwner($idOwner)
	    {
	        $this->idOwner = $idOwner;

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


	    public function getDates()
	    {
	        return $this->dates;
	    }


	    public function setDates($dates)
	    {
	        $this->dates = $dates;

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
	}
 ?>