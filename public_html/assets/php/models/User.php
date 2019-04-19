<?php

 class User {
    private $id;
    private $email;
    private $username;

    private function __constructor() {
    }

    public static function create($id, $email, $username) {
        $user = new User();
        $user->id = $id;
        $user->email = $email;
        $user->username = $username;
        return $user;
    }
}
?>