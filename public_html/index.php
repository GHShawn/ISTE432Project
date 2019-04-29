<?php
    ini_set("display_errors","1");
    error_reporting(E_ALL);
    
    define('ROOT','assets/php/');
    include_once(ROOT . 'business/UserManager.php');
  //  include_once (ROOT.'controler/indexControl.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = htmlentities(strip_tags(trim( $_POST["username"])));
        $password = htmlentities(strip_tags(trim( $_POST["password"])));
        $conn = new UserManager();
        $user = $conn->loginUser($username,$password);
        if ($user instanceof  User) {
            header('location: main_info.php');
            die();
        }
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

	  <form  id="LOGIN" class="form-signin" method="post">
	  <p class="textCenter">Welcome to use our Site. Please <Strong>LOGIN</Strong> your account. Or <a id="singup" onclick="switchSingp();">Register</a> here</P>
	  <label for="username" class="box-only">User Name</label>
	  <input type="username" name="username" id="username" value="test1" class="form-control" placeholder="User Name" required autofocus>
	  <label for="password" class="box-only">Password</label>
	  <input type = "password" name = "password"  value="password1" class="form-control" placeholder="Password" required />
	  <div class="checkbox">
		<label>
		  <input type="checkbox" value="remember-me"> Remember me
		</label>
	  </div>
	  <button class="form-control" name="login" id="submitJB" type="submit">Sign in</button>
          <span><?php if (isset($user)) echo $user ?></span>
	   </form>

  </body>
</html>
