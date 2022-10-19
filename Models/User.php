<?php 

	namespace Models;

	class User {

		private $id;
		private $username;
		private $password;
		private $userType;
		private $name;
		private $lastname;
		private $DNI;
		private $phoneNumber;
		private $email;


	    public function getId()
	    {
	        return $this->id;
	    }
	    public function setId($id)
	    {
	        $this->id = $id;

	        return $this;
	    }
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
	    public function getUserType()
	    {
	        return $this->userType;
	    }

	    public function setUserType(eUserType $userType)
	    {
	        $this->userType = $userType;

	        return $this;
	    }
	    public function getName()
	    {
	        return $this->name;
	    }

	    public function setName($name)
	    {
	        $this->name = $name;

	        return $this;
	    }
	    public function getLastname()
	    {
	        return $this->lastname;
	    }

	    public function getDNI()
	    {
	        return $this->DNI;
	    }

	    public function setDNI($DNI)
	    {
	        $this->DNI = $DNI;

	        return $this;
	    }

	    public function setLastname($lastname)
	    {
	        $this->lastname = $lastname;

	        return $this;
	    }

	    public function getPhoneNumber()
	    {
	        return $this->phoneNumber;
	    }


	    public function setPhoneNumber($phoneNumber)
	    {
	        $this->phoneNumber = $phoneNumber;

	        return $this;
	    }
	    public function getEmail()
	    {
	        return $this->email;
	    }


	    public function setEmail($email)
	    {
	        $this->email = $email;

	        return $this;
	    }
    
}