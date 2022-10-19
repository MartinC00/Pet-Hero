<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO 
    {
        function add(User $user);
        function getNextId();
        function saveData();
        function retrieveData();
        function delete($id);
        function getPositionById($id);
        function getAll();
    }
?>