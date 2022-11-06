<?php 

	namespace Models;

	class UserType
	{
		private $id;
		private $nameType;

	    public function getId()
	    {
	        return $this->id;
	    }

	    public function setId($id)
	    {
	        $this->id = $id;

	        return $this;
	    }

	    public function getNameType()
	    {
	        return $this->nameType;
	    }

	    public function setNameType($nameType)
	    {
	        $this->nameType = $nameType;

	        return $this;
	    }
	}

 ?>