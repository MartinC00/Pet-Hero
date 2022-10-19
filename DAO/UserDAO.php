<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;

    class UserDAO implements IUserDAO {
        private $userList = array();
        private $fileName = ROOT."Data/Users.json";

        public function GetByUserName($userName) {
            $user = null;

            $this->RetrieveData();

            $users = array_filter($this->userList, function($user) use($userName){
                return $user->getUserName() == $userName;
            });

            $users = array_values($users); //Reordering array indexes

            return (count($users) > 0) ? $users[0] : null;
        }

        private function RetrieveData() {
             $this->userList = array();

             if(file_exists($this->fileName)) {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content) {
                     $user = new User();
                     $user->setUserName($content["userName"]);
                     $user->setPassword($content["password"]);

                     array_push($this->userList, $user);
                 }
             }
        }  
    }