<?php

namespace Models;

class Coupon
{
    private $id;
    private $idReserve;
    private $code;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdReserve()
    {
        return $this->idReserve;
    }

    public function setIdReserve($idReserve)
    {
        $this->idReserve = $idReserve;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

}