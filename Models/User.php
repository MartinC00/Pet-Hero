<?php 

	namespace Models;
	use Models\eUserType;

	class User {

		private $id;
		private $username;
		private $password;
		private $name;
		private $lastname;
		private $dni;
		private $phone;
		private $email;
		private $userType;


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

	    public function setUserType($userType)
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

	    public function getDni()
	    {
	        return $this->dni;
	    }

	    public function setDni($dni)
	    {
	        $this->dni = $dni;

	        return $this;
	    }

	    public function setLastname($lastname)
	    {
	        $this->lastname = $lastname;

	        return $this;
	    }

	    public function getPhone()
	    {
	        return $this->phone;
	    }


	    public function setPhone($phone)
	    {
	        $this->phone = $phone;

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