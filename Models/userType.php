<?php 

	namespace Models;
	
	class userType
	{
		private $name; //Keeper/Owner
		private $id;
		private $description;

	    public function getName()
	    {
	        return $this->name;
	    }

	    public function setName($name)
	    {
	        $this->name = $name;

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

	    public function getDescription()
	    {
	        return $this->description;
	    }

	    public function setDescription($description)
	    {
	        $this->description = $description;

	        return $this;
	    }
	}

 ?>