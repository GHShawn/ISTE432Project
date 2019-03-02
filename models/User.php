<?php

class User {
    private $id;
    private $email;
    private $username;

    public function __constructor() {

    }

    public static function create($id, $email, $username) {
        $user = new User();
        $user->id = $id;
        $user->email = $email;
        $uesr->username = $username;
        return $user;
    }
}