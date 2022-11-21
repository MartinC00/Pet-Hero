<?php
    namespace Models;
    
    abstract class PaymentStatus
    {
        const Unpayed = 0;
        const Signed = 1;
        const Payed = 2;
    }
?>