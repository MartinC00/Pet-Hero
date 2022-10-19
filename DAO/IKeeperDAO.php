<?php
    namespace DAO;

    use Models\Keeper;

    interface IKeeperDAO 
    {
        function add(Keeper $keeper);
        function getNextId();
        function saveData();
        function retrieveData();
        function delete($id);
        function getPositionById($id);
        function getAll();
    }
?>