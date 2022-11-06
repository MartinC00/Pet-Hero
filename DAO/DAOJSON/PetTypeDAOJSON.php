<?php 

	namespace DAO;

	use Models\PetType;

	class PetTypeDAO
	{
        private $petTypeList = array();
        private $fileName = ROOT."Data/PetType.json";

        public function add(PetType $petType)
        {
            $this->retrieveData();
            $petType->setId($this->GetNextId());
            array_push($this->petTypeList, $petType);
            $this->SaveData();
        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->petTypeList;
        }
	       
	    public function getById($id)
        {
            $this->retrieveData();
            foreach($this->petTypeList as $petType)
            {
                if($petType->getId()==$id) return $petType;    
            }
            return null;
        }

	    public function delete($id)
	    {
	        $this->retrieveData();
	        $positionToDelete = $this->getPositionById($id);
	        if(!is_null($positionToDelete))
	        {
	            unset($this->petTypeList[$positionToDelete]);
	        }
	        $this->saveData();
	    }

	    public function getPositionById($id)
	    {
	        $position=0;
	        foreach($this->petTypeList as $petType)
	        {
	            if($petType->getId()==$id) return $position;
	            $position++;
	        }
	        return null;
	    }

        public function getNextId()
        {
            $id = 0;
            foreach($this->petTypeList as $petType)
            {
                if($petType->getId() > $id) $id=$petType->getId();
            }
            return $id + 1;
        }

      	private function retrieveData()
      	{
      		$this->petTypeList=array();
      		if(file_exists($this->fileName))
      		{
      			$jsonContent = file_get_contents($this->fileName);
      			$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
      	
      			foreach($arrayToDecode as $valuesArray)
      			{
      				$petType = new petType();
      				$petType->setId($valuesArray["id"]);
      				$petType->setName($valuesArray["name"]);

      				array_push($this->petTypeList, $petType);
      			}
      		}
      	}
        private function saveData()
        {
        	$arrayToEncode = array();
        	foreach($this->petTypeList as $petType)
        	{
        		$valuesArray=array();
        		$valuesArray["id"] = $petType->getId();
        		$valuesArray["name"] = $petType->getName();
        		array_push($arrayToEncode, $valuesArray);
        	}
        
        	$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        	file_put_contents($this->fileName, $jsonContent);        
        }
    }

 ?>