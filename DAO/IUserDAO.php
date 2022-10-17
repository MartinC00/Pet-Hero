<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO {
        function getByUserName($userName);
    }