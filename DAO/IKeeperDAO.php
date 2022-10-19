<?php
    namespace DAO;

    use Models\Keeper;

    interface IKeeperDAO 
    {
        function add(Keeper $keeper);
        function getNextId();
        function delete($id);
        function getPositionById($id);
        function getAll();
    }
?>