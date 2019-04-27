<?php

ini_set("display_errors", "1");
error_reporting(E_ALL);
require "dbinfo.php";
include_once dirname(__FILE__) . '/../models/User.php';

class UserManager
{

    private $conn = NULL;
    public static $error = NULL;

    function __construct()
    {
        $conn = pg_connect(DB_HOST . ' ' . DB_PORT . ' ' . DB_DATABASE . ' ' . DB_USERNAME . ' ' . DB_PASSWORD)
        or die("Could not connect to server\n");
        $this->conn = $conn;
    }

    function loginUser($user, $pass)
    {
        $query = 'SELECT user_id, email, username, pswd FROM USERS WHERE username=$1';
        $stmt = pg_prepare($this->conn, "selectUser", $query);
        $result = pg_execute($this->conn, "selectUser", array($user)); //array($user, encryptPassword($pass)));

        $count = pg_num_rows($result);
        if ($count == 1) {
            header("location: main_info.php");
            $row = pg_fetch_row($result);
            $id = $row[0];
            $email = $row[1];
            $name = $row[2];
            $pswd = $row[3];
            pg_close($this->conn);
            if (password_verify($pass, $pswd))
                return User::create($id, $email, $name);
            else
                return 'Incorrect password';
        } else {
            $error = "You are not login!!!";
            return $error;
        }
    }

    function createUser($email, $username, $pswd)
    {
        $query =
            'insert into USERS(username, email,pswd) values ($1, $2, $3) ';
        $stmt = pg_prepare($this->conn, "createUser", $query);
        $result = pg_execute($this->conn, "createUser",array($username, $email, $this->encryptPassword($pswd)));// array($user->email, encryptPassword($password), $user->username));
        $row = pg_fetch_row($result);
        pg_close($this->conn);
        return $row['0'];
    }

    function encryptPassword($pass)
    {
        return password_hash($pass, PASSWORD_ARGON2ID);
    }
}
