<?php

namespace DAO;

    use DAO\IPetDAO as IPetDAO;
    use Models\Pet as Pet;

    class UserDAO implements IPetDAO 
    {
        private $petList = array();
        private $filename = ROOT."Data/Pets.json";

        public function add(Pet $pet)
        {
            $this->retrieveData();
            $pet->setId($this->getNextId());
            array_push($this->petList, $pet);
            $this->saveData();
        }

        public function getNextId()
        {
            $id=0;
            foreach($this->petList as $pet)
            {
                if($pet->getId() > $id) $id=$pet->getId();
                $id++;
            }
            return $id+1;
        }

        private function saveData()
        {
            $arrayToEncode = array();
            foreach($this->petList as $pet)
            {
                $arrayValues = array();
                $arrayValues["id"] = $pet->getId();
                $arrayValues["userId"] = $pet->getUserId();
                $arrayValues["name"] = $pet->getName();
                $arrayValues["breed"] = $pet->getBreed();
                $arrayValues["size"] = $pet->getSize();
                $arrayValues["description"] = $pet->getDescription();
                $arrayValues["photo"] = $pet->getPhoto();
                $arrayValues["vaccines"] = $pet->getVaccines();
                $arrayValues["video"] = $pet->getVideo();

                array_push($arrayToEncode, $arrayValues);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonContent);
        }

        private function retrieveData()
        {
            $this->petList = array();

            if(file_exists($this->filename))
            {
                $jsonContent = file_get_contents($this->filename);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $arrayValues)
                {
                    $pet = new Pet();
                    $pet->setId($arrayValues["id"]); 
                    $pet->setUserId($arrayValues["userId"]); 
                    $pet->setName($arrayValues["name"]); 
                    $pet->setBreed($arrayValues["breed"]);
                    $pet->setSize($arrayValues["size"]);
                    $pet->setDescription($arrayValues["description"]);
                    $pet->setPhoto($arrayValues["photo"]);
                    $pet->setVaccines($arrayValues["vaccines"]);
                    $pet->setVideo($arrayValues["video"]);

                    array_push($this->petList, $pet);
                }
            }
        } 

        public function delete($id)
        {
            $this->retrieveData();
            $positionToDelete = $this->getPositionById($id);
            if(!is_null($positionToDelete))
            {
                unset($this->petList[$positionToDelete]);
            }
            $this->saveData();
        }
        public function getPositionById($id)
        {
            $position=0;
            foreach($this->petList as $pet)
            {
                if($pet->getId()==$id) return $position;
                $position++;
            }
            return null;
        }
        
        public function getByUserId($userId)
        {
            $this->retrieveData();
            foreach($this->petList as $pet)
            {
                if($pet->getUserId()==$userId) return $pet;
            }
            return null;
        }

        public function getListById($userId)
        {
            $this->retrieveData();
            $userPetsList = array();
            foreach($this->petList as $pet)
            {
                if($pet->getUserId()==$userId) array_push($userPetsList, $pet);
            }
            return $userPetsList;
        }
        
        public function getAll()
        {
            $this->retrieveData();
            return $this->petList;
        }

    }

?>