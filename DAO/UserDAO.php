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

        public function getNextId()
        {
            $id=0;
            foreach($this->userList as $user)
            {
                if($user->getId() > $id) $id=$user->getId();
            }
            return $id+1;
        }

        private function saveData()
        {
            $arrayToEncode = array();
            foreach($this->userList as $user)
            {
                $arrayValues = array();
                $arrayValues["id"] = $user->getId();
                $arrayValues["username"] = $user->getUsername();
                $arrayValues["password"] = $user->getPassword();
                $arrayValues["name"] = $user->getName();
                $arrayValues["lastname"] = $user->getLastname();
                $arrayValues["dni"] = $user->getDni();
                $arrayValues["phone"] = $user->getPhone();
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
                    $user->setId($arrayValues["id"]);
                    $user->setUsername($arrayValues["username"]);
                    $user->setPassword($arrayValues["password"]);
                    $user->setName($arrayValues["name"]);
                    $user->setLastname($arrayValues["lastname"]);
                    $user->setDni($arrayValues["dni"]);
                    $user->setPhone($arrayValues["phone"]);
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
        public function getPositionById($id)
        {
            $position=0;
            foreach($this->userList as $user)
            {
                if($user->getId()==$id) return $position;
                $position++;
            }
            return null;
        }
        public function getByUsername($username)
        {
            $this->retrieveData();
            foreach($this->userList as $user)
            {
                if($user->getUsername()==$username) return $user;
            }
            return null;
        }

        public function getById($id)
        {
            $this->retrieveData();
            foreach($this->userList as $user)
            {
                if($user->getId()==$id) return $user
;           }
            return null;
        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->userList;
        }

        public function modify(User $user)
        {
            $this->retrieveData();
            $this->delete($user->getId());
            array_push($this->userList, $user);
            $this->saveData();
        }

    }