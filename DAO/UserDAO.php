<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;

    class UserDAO implements IUserDAO 
    {
        private $userList = array();
        private $filename = ROOT."Data/Users.json";

        public function add(User $user)
        {
            $this->retrieveData();
            $user->setId($this->getNextId());
            array_push($this->userList, $user);
            $this->saveData();
        }

        private function getNextId()
        {
            $id=0;
            foreach($this->userList as $user)
            {
                if($user->getId() > $id) $id=$user->getId();
                $id++;
            }
            return $id+1;
        }

        private function saveData()
        {
            $arrayToEncode = array();
            foreach($this->userList as $user)
            {
                $arrayValues = array();
                $arrayValues["username"] = $user->getUsername();
                $arrayValues["password"] = $user->getPassword();
                $arrayValues["name"] = $user->getName();
                $arrayValues["lastname"] = $user->getLastname();
                $arrayValues["dni"] = $user->getDNI();
                $arrayValues["phoneNumber"] = $user->getPhoneNumber();
                $arrayValues["email"] = $user->getEmail();
                $arrayValues["userType"] = $user->getUserType();

                array_push($arrayToEncode, $arrayValues);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonContent);
        }

        private function retrieveData()
        {
            $this->userList = array();

            if(file_exists($this->filename))
            {
                $jsonContent = file_get_contents($this->filename);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $arrayValues)
                {
                    $user = new User();
                    $user->setUsername($arrayValues["username"]);
                    $user->setPassword($arrayValues["password"]);
                    $user->setName($arrayValues["name"]);
                    $user->setLastname($arrayValues["lastname"]);
                    $user->setDNI($arrayValues["dni"]);
                    $user->setPhoneNumber($arrayValues["phoneNumber"]);
                    $user->setEmail($arrayValues["email"]);
                    $user->setUserType($arrayValues["userType"]);
                    array_push($this->userList, $user);
                }
            }
        } 

        public function delete($id)
        {
            $this->retrieveData();
            $positionToDelete = $this->getPositionById($id);
            if(!is_null($positionToDelete))
            {
                unset($this->userList[$positionToDelete]);
            }
            $this->saveData();
        }
        private function getPositionById($id)
        {
            $position=0;
            foreach($this->userList as $user)
            {
                if($user->getId()==$id) return $position;
                $position++;
            }
            return null;
        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->userList;
        }


    }