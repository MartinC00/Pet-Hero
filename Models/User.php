<?php 

	namespace Models;

	class User
	{
		private $id;
		private $username;
		private $password;
		private $userTypeId
		private $name;
		private $lastname;
		private $phoneNumber;
		private $email;
		private $adress;

	    public function getUsername()
	    {
	        return $this->username;
	    }

	    public function setUsername($username)
	    {
	        $this->username = $username;

	        return $this;
	    }

	    public function getPassword()
	    {
	        return $this->password;
	    }

	    public function setPassword($password)
	    {
	        $this->password = $password;

	        return $this;
	    }

	    public function getUserTypeId()
	    {
	        return $this->userTypeId;
	    }
	    
	    public function setUserTypeId($userTypeId)
	    {
	        $this->userTypeId = $userTypeId;

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
	}
?>