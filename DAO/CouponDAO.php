<?php

namespace DAO;

use Models\Coupon;

class CouponDAO
{
    private $connection;

    public function add($coupon)
    {
        $query = "CALL coupons_add(?, ?)";

        $parameters['idReserve_'] = $coupon->getIdReserve();
        $parameters['code_'] = $coupon->getCode();

        try {
            $this->Connection = Connection::getInstance();
            return $this->Connection->ExecuteNonQuery($query,$parameters, QueryType::StoredProcedure);
        }
        catch(\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getAll() {
        $couponList = array();
        $query = "CALL coupons_getAll()";

        try{
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            foreach($result as $row) {
                $coupon = new Coupon();
                $coupon->setId($row["id"]);
                $coupon->setIdReserve($row["idReserve"]);
                $coupon->setCode($row["code"]);

                array_push($couponList, $coupon);
            }
            return $couponList;
        }
        catch(\PDOException $ex){
            echo $ex->getMessage();
        }
    }
    public function getByReserveId($id)
    {
        $couponList=$this->getAll();

        foreach($couponList as $coupon)
        {
            if($coupon->getIdReserve()==$id) return $coupon;
        }
        return null;
    }
}