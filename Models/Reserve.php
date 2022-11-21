<?php 

	namespace Models;

	class Reserve
	{
		private $id;
		private $idUserOwner;
		private $idKeeper;
		private $idPets;
		private $initialDate;
		private $endDate; 
		private $totalPrice;
		private $reserveStatus;
		private $paymentStatus;

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

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

	    public function getReserveStatus()
	    {
	        return $this->reserveStatus;
	    }

	    public function setReserveStatus($reserveStatus)
	    {
	        $this->reserveStatus = $reserveStatus;

	        return $this;
	    }

	    public function getPaymentStatus()
	    {
	        return $this->paymentStatus;
	    }

	    public function setPaymentStatus($paymentStatus)
	    {
	        $this->paymentStatus = $paymentStatus;

	        return $this;
	    }
	}
 ?>