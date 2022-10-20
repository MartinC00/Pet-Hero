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
                $arrayValues["name"] = $pet->getName();
                $arrayValues["ownerId"] = $pet->getOwnerId();
                $arrayValues["size"] = $pet->getSize();
                $arrayValues["photo"] = $pet->getPhoto();
                $arrayValues["breed"] = $pet->getBreed();
                $arrayValues["vaccines"] = $pet->getVaccines();
                $arrayValues["description"] = $pet->getDescription();

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
                    $pet->setId($arrayValues["id"]); //
                    $pet->setBreed($arrayValues["breed"]);
                    $pet->setDescription($arrayValues["description"]);
                    $pet->setPhoto($arrayValues["photo"]);
                    $pet->setSize($arrayValues["size"]);
                    $pet->setVaccines($arrayValues["vaccines"]); //owner id?
 //                   $pet->set($arrayValues["phone"]);
//                 $pet->setEmail($arrayValues["email"]);
  //                  $pet->setUserType($arrayValues["userType"]);
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
        public function getByOwnerId($ownerId)
        {
            $this->retrieveData();
            foreach($this->petList as $pet)
            {
                if($pet->getOwnerId()==$ownerId) return $pet;
            }
            return null;
        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->petList;
        }


    }

?>