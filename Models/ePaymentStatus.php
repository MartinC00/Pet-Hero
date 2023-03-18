<?php
    namespace Models;
    
    enum ePaymentStatus
    {
        const Unpayed = 0;
        const Signed = 1;
        const Payed = 2;
    }
?>