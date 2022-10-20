<?php 
	namespace DAO;

	use Models\Keeper;
	use DAO\IKeeperDAO;

	class KeeperDAO implements IKeeperDAO
	{
		private $keepersList = array();
		private $filename = ROOT . "Data/Keepers.json";

		public function add(Keeper $keeper)
		{
			$this->retrieveData();
			$keeper->setKeeperId($this->getNextId());
			array_push($this->keepersList, $keeper);
			$this->saveData();
		}

		private function saveData()
		{
			$arrayToEncode = array();
			foreach($this->keepersList as $keeper)
			{
				$valuesArray=array();
				$valuesArray["keeperId"] = $keeper->getKeeperId();
				$valuesArray["userId"] = $keeper->getUserId();
				$valuesArray["petSize"] = $keeper->getPetSize();
				$valuesArray["initialDate"] = $keeper->getInitialDate();
				$valuesArray["endDate"] = $keeper->getEndDate();
				$valuesArray["price"] = $keeper->getPrice();
				array_push($arrayToEncode, $valuesArray);
			}
		
			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
			file_put_contents($this->filename, $jsonContent);
		
		}
		private function retrieveData()
		{
			$this->keepersList=array();
			if(file_exists($this->filename))
			{
				$jsonContent = file_get_contents($this->filename);
				$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
		
				foreach($arrayToDecode as $valuesArray)
				{
					$keeper = new Keeper();
					$keeper->setKeeperId($valuesArray["keeperId"]);
					$keeper->setUserId($valuesArray["userId"]);
					$keeper->setPetSize($valuesArray["petSize"]);
					$keeper->setInitialDate($valuesArray["initialDate"]);
					$keeper->setEndDate($valuesArray["endDate"]);
					$keeper->setPrice($valuesArray["price"]);					
								
					array_push($this->keepersList, $keeper);
				}
			}
		}

        public function getNextId()
        {
            $id=0;
            foreach($this->keepersList as $keeper)
            {
                if($keeper->getKeeperId() > $id) $id=$keeper->getKeeperId();
                $id++;
            }
            return $id+1;
        }
        public function delete($id)
        {

        }

        public function getPositionById($id)
        {
            $position=0;
            foreach($this->keepersList as $keeper)
            {
                if($keeper->getId()==$id) return $position;
                $position++;
            }
            return null;
        }

        public function getAll()
        {
        	$this->retrieveData();
        	return $this->keepersList;
        }
	}

 ?>