<?php

 class User {
    public $id;
    public $email;
    public $username;

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