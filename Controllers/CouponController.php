<?php

    namespace Controllers;

    use DAO\CouponDAO;
    use Models\Coupon;

class CouponController
{
    public $couponDAO;

    public function __construct()
    {
        $this->couponDAO = new CouponDAO();
    }

    public function add($idReserve) {
        $coupon = new Coupon();

        $coupon->setIdReserve($idReserve);
        $coupon->setCode(uniqid());

        $this->couponDAO->add($coupon);

        return $coupon->getCode();
    }


}