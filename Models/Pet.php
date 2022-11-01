<?php 
    use Models\PetType;
	namespace Models;

	class Pet 
    {
        private $id;
        private $userId;
        private $name;
        private $breed; // raza
        private $size;
        private $description;
        private $photo; //del perro
        private $vaccines; // carnet de vacunacion (foto)
        private $video;
        private $petType;
        private $isActive; 
        

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }
        
        public function getUserId()
        {
            return $this->userId;
        }

        public function setUserId($userId)
        {
            $this->userId = $userId;

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

        public function getBreed()
        {
            return $this->breed;
        }

        public function setBreed($breed)
        {
            $this->breed = $breed;

            return $this;
        }

        public function getSize()
        {
            return $this->size;
        }

        public function setSize($size)
        {
            $this->size = $size;

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

        public function getPhoto()
        {
            return $this->photo;
        }

        public function setPhoto($photo)
        {
            $this->photo = $photo;

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

        public function getVideo()
        {
            return $this->video;
        }

        public function setVideo($video)
        {
            $this->video = $video;

            return $this;
        }

        public function getPetType()
        {
            return $this->petType;
        }

        public function setPetType(PetType $petType)
        {
            $this->petType = $petType;

            return $this;
        }

        public function getIsActive()
        {
            return $this->isActive;
        }

        public function setIsActive(bool $isActive)
        {
            $this->isActive = $isActive;

            return $this;
        }
    }
 ?>