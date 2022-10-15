<?php 

	namespace Models;

	class Pet
	{
		private $name;
		private $ownerId;
		private $size;
		private $photo;
		private $breed; //raza
		private $vaccines; //vacunas, png
		private $description;

	    public function getSize()
	    {
	        return $this->size;
	    }

	    public function setSize($size)
	    {
	        $this->size = $size;

	        return $this;
	    }

	    public function getPhoto()
	    {
	        return $this->photo;
	    }

	    public function setPhoto($photo)
	    {
	        $this->photo = $photo;

	        return $this;
	    }

	    public function getBreed()
	    {
	        return $this->breed;
	    }

	    public function setBreed($breed)
	    {
	        $this->breed = $breed;

	        return $this;
	    }

	    public function getVaccines()
	    {
	        return $this->vaccines;
	    }

	    public function setVaccines($vaccines)
	    {
	        $this->vaccines = $vaccines;

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
	

 ?>