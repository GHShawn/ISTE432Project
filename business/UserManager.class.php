<?php
require "dbinfo";
include_once "../models/User";

class UserManager {

    function __construct() {
        $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    }

    function loginUser($user, $pass) {
        $query = "SELECT user_id, email, userName FROM user WHERE email LIKE ? AND pswd LIKE ?";
        $stmt = $this->db->prepare($query);
        // Encrypted given password should match encrypted password in db
        $stmt->bind_param("ss", $user, encryptPassword($pass));

        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_results === 0)
            return false;
        $stmt->bind_result($id, $email, $name); 
        $stmt->fetch();

        $stmt->close();

        return User.create($id, $email, $name);
    }

    function createUser(User $user, $password) {
        $query = "INSERT INTO user (email, pswd, userName) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $user->email, encryptPassword($password), $user->username);

        $stmt->execute();
        $user_id = $stmt->insert_id;
        $stmt->close();
        return $user_id;
    }


    // TODO: Move to a seperate service maybe?
    function encryptPassword($pass) {
        // TODO: implement encryption or hasing
        return $pass;
    }

}