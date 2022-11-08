<?php

    namespace DAO;

    use Models\Reserve;

    class ReserveDAO implements IReserveDAO
    {
        private $connection;
        private $tableName = "Reserves";

        public function add($reserve)
        {
            

        }

        public function getAll() {

        }

        public function getReservesByKeeper() {
            $reserveList = $this->getAll();

            foreach($reserveList as $reserve)
            {
                if($reserve->getKeeperId()==$idKeeper)
                {
                    array_push($keeperReservesList, $reserve); //lista de reservas de ESE keeper
                }
            }

            return $reserveList;
        }
    }