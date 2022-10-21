<?php
    namespace DAO;

    use Models\Pet;

    interface IPetDAO 
    {
        function add(Pet $pet);
        function getNextId();
        function delete($id);
        function getPositionById($id);
        function getAll();
    }
?>