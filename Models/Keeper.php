<?php 
	namespace Models;

	class Keeper 
	{
		private $keeperId;
		private $userId;
		private $address;
		private $petSize;
		private $initialDate; // desde el 15/07
		private $endDate; // hasta el 20/10
		private $price;


	    public function getUserId()
	    {
	        return $this->userId;
	    }

	    public function setUserId($userId)
	    {
	        $this->userId = $userId;

	        return $this;
	    }

	    public function getPetSize()
	    {
	        return $this->petSize;
	    }

	    public function setPetSize($petSize)
	    {
	        $this->petSize = $petSize;

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

	    public function getEndDate()
	    {
	        return $this->endDate;
	    }

	    public function setEndDate($endDate)
	    {
	        $this->endDate = $endDate;

	        return $this;
	    }

	    public function getPrice()
	    {
	        return $this->price;
	    }
	    public function setPrice($price)
	    {
	        $this->price = $price;

	        return $this;
	    }
	    
	    public function getKeeperId()
	    {
	        return $this->keeperId;
	    }

	    public function setKeeperId($keeperId)
	    {
	        $this->keeperId = $keeperId;

	        return $this;
	    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}