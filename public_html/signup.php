<?php
    ini_set("display_errors","1");
    error_reporting(E_ALL);

    define('ROOT','assets/php/');

    include_once(ROOT . 'business/UserManager.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $signupUsername = htmlentities(strip_tags(trim( $_POST["signup-username"])));
        $signupEmail = htmlentities(strip_tags(trim( $_POST["signup-email"])));
        $signupPassword = htmlentities(strip_tags(trim( $_POST["signup-password"])));
        $reSignupPassword = htmlentities(strip_tags(trim( $_POST["re-signup-password"])));
        $conn = new UserManager();
        $conn->createUser($signupEmail,$signupUsername,$signupPassword);
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sample Login</title>
    <link href="assets/css/logIn.css" rel="stylesheet">
    <script src='assets/js/index.js'></script>

</head>
<body class="text-center">
<form id="SINGUP" class="form-signin" method="post" action="signup.php">
    <h1 id="margincenter">PLEASE SIGN UP</h1>

    <label for="username" class="box-only">User Name</label>
    <input type="username" name="signup-username" id="newUserName"class="form-control" placeholder="User Name" value="usernmae" required autofocus>

    <label for="email" class="box-only">Password</label>
    <input type="email"  name="signup-email" class="form-control" id="newEmail" placeholder="Email" value="emial@gmail.com" required >

    <label for="password" class="box-only">Password</label>
    <input type = "password" name="signup-password"  id= "1stpassword" class="form-control" placeholder="Password" value="testPassword" required />

    <label for="password" class="box-only">Password</label>
    <input type = "password" name = "re-signup-password" id='2ndpassword' class="form-control" placeholder="confirm password" value="testPassword2" required />
    <button class="form-control" name="register" type="submit">Sign up</button>
    <a id='switchLogin' onclick="switchLogin();">Switch LOGIN</a>
</form>
</body>
</html>
