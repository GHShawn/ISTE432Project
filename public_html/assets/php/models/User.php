<?php

 class User {
    private  $id;
    private  $email;
    private  $username;
    static $user = __CLASS__;
    private function __constructor() {
    }

    public static function create($id, $email, $username) {
        $user = new static();
        $user->id = $id;
        $user->email = $email;
        $user->username = $username;
        return $user;
    }
    public function getSome(){
        $dum = get_object_vars($this);
       return $dum;
    }
}
?>
