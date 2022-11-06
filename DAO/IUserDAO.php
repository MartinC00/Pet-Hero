<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO 
    {
        function add(User $user);
        function getAll();
        function modify(User $user);
    }
?>