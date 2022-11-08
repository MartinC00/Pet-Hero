<?php
    namespace Models;
    
    abstract class ReserveStatus
    {
        const Rejected = 0;
        const Accepted = 1;
        const Pending = 2;
    }
?>