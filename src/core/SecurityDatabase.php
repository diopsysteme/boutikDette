<?php

namespace Core;

use PDO;

class SecurityDatabase
{
    private $database;

    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;
        Session::start();
    }

    public function login($username, $password)
    {
        $sql = "SELECT mail,password FROM utilisateurs WHERE login = :username AND password = :password";
        $params = ['username' => $username, 'password' => $password];
        $user = $this->database->query($sql, $params, PDO::FETCH_ASSOC);

        if (!empty($user)) {

            Session::set('user', $user[0]);
            return true;
        }
        return false;
    }

    public function isLogged()
    {
        return Session::get('user') !== null;
    }

    public function getUserLogged()
    {
        return Session::get('user');
    }

    public function getRoles($userId)
    {
        $sql = "SELECT r.libelle 
                FROM role r 
                JOIN utilisateur u ON r.id = u.idrole 
                WHERE u.id = :userId";
        $params = ['userId' => $userId];
        return $this->database->query($sql, $params, PDO::FETCH_ASSOC);
    }
}
