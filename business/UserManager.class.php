<?php
require "dbinfo";
include_once "../models/User";

class UserManager {

    private $db = NULL;

    function __construct() {
        $db = pg_connect(DB_HOST.' '.DB_PORT.' '.DB_DATABASE.' '.DB_USERNAME.' '.DB_PASSWORD)
                or die("Could not connect to server\n");
        $this->db = $db;
    }

    function loginUser($user, $pass) {
        $query = "SELECT user_id, email, userName FROM user WHERE email LIKE $1 AND pswd LIKE $2";
        $stmt = pg_prepare($this->db, "selectUser", $query);
        <?php
    ini_set("display_errors","1");
    error_reporting(E_ALL);
    require "dbinfo.php";

    include_once "User.php";

class UserManager {

    private $conn = NULL;

    function __construct() {
        $conn = pg_connect(DB_HOST.' '.DB_PORT.' '.DB_DATABASE.' '.DB_USERNAME.' '.DB_PASSWORD)
                or die("Could not connect to server\n");
        $this->conn = $conn;

    }
    function loginUser($user, $pass) {
        $query = "SELECT user_id, email, username FROM USERS WHERE username='$user' AND pswd='$pass'";

        $stmt = pg_prepare($this->conn, "selectUser", $query) or die ("Can not find it");
        $result = pg_execute($this->conn, "selectUser", array( )); //array($user, encryptPassword($pass)));

        if(!$result){
            echo "fail to login";
        }

        $row = pg_fetch_row($result);
        $id = $row[0];
        $email = $row[1];
        $name = $row[2];

        pg_close($this->conn);

       // return User.create($id, $email, $name);//dont understand function

    }
    //the function still not test
    function createUser(User $user, $password) {
        $query = "INSERT INTO user (email, pswd, userName) VALUES ($1, $2, $3) RETURNING id";
        $stmt = pg_prepare($this->db, "createUser", $query);

        $result = pg_execute($this->db, "createUser", array($user->email, encryptPassword($password), $user->username));
        $row = pg_fetch_row($result);
        $stmt->close();
        return $row['0'];
    }
    // TODO: Move to a seperate service maybe?
    function encryptPassword($pass) {
        // TODO: implement encryption or hasing
        return $pass;
    }
}

    if(isset($_POST['login']))
    {
		$username = htmlentities(strip_tags(trim( $_POST["username"])));
		$password = htmlentities(strip_tags(trim( $_POST["password"])));
		$conn = new UserManager();

	    $conn->loginUser($username,$password);

    }

?>
        $result = pg_execute($this->db, "selectUser", array($user, encryptPassword($pass)));
        if (pg_num_rows($result) === 0)
            return false;
        
        $id = $data->user_id;
        $email = $data->email;
        $name = $data->userName;

        $stmt->close();

        return User.create($id, $email, $name);
    }

    function createUser(User $user, $password) {
        $query = "INSERT INTO user (email, pswd, userName) VALUES ($1, $2, $3) RETURNING id";
        $stmt = pg_prepare($this->db, "createUser", $query);
        
        $result = pg_execute($this->db, "createUser", array($user->email, encryptPassword($password), $user->username));
        $row = pg_fetch_row($result);
        $stmt->close();
        return $row['0'];
    }


    // TODO: Move to a seperate service maybe?
    function encryptPassword($pass) {
        // TODO: implement encryption or hasing
        return $pass;
    }

}
