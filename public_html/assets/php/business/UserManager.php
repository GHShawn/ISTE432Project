<?php
    ini_set("display_errors","1");
    error_reporting(E_ALL);
    require "dbinfo.php";
    include_once dirname(__FILE__) . '/../models/User.php';

class UserManager {

    private $conn = NULL;
    public static $error = NULL;

    function __construct() {
        $conn = pg_connect(DB_HOST.' '.DB_PORT.' '.DB_DATABASE.' '.DB_USERNAME.' '.DB_PASSWORD)
                or die("Could not connect to server\n");
        $this->conn = $conn;
    }
    function loginUser($user, $pass) {
        $query = "SELECT user_id, email, username FROM USERS WHERE username='$user' AND pswd='$pass'";
        $stmt = pg_prepare($this->conn, "selectUser", $query);
        $result = pg_execute($this->conn, "selectUser", array( )); //array($user, encryptPassword($pass)));

        $count =  pg_num_rows($result);
        if($count == 1) {
//            session_register("myusername");
//            $_SESSION['login_user'] = $myusername;
            header("location: main_info.php");
            $row = pg_fetch_row($result);
            $id = $row[0];
            $email = $row[1];
            $name = $row[2];
            pg_close($this->conn);
            return User::create($id, $email, $name);
        }else {
             $error= "You are not login!!!";
             return $error;
        }
    }

    function createUser($email, $username, $pswd) {
        $query =
        "insert into USERS(username, email,pswd) values ('$username', '$email','$pswd') ";
        $stmt = pg_prepare($this->conn, "createUser", $query);
        $result = pg_execute($this->conn, "createUser",array());// array($user->email, encryptPassword($password), $user->username));
        $row = pg_fetch_row($result);
        pg_close($this->conn);
        return $row['0'];
    }
    // TODO: Move to a seperate service maybe?
    function encryptPassword($pass) {
        // TODO: implement encryption or hasing
        return $pass;
    }
}
?>