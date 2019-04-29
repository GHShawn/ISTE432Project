<!DOCTYPE html>
<html>
<head>
<title><?php echo $page; ?></title>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<script src="assets/js/javascript.js"></script>
</head>
<body>

<span style="font-size:30px;cursor:pointer;float:right;margin-right:5%;margin-top:1.5%" onclick="openNav()"><i class="far fa-2x fa-user-circle"></i></span>



<div id="title">
<img class="logo" src="assets/images/logo.png" alt="logo">
</div>


  <form action="action_page.php" method="post">
  <label>Add</label><input type="text" name="ingredients" placeholder="Search by ingredients..">
  <!--<input type="submit" name="button" value="Add">-->
  <label>Delete</label>
  <input type="text" name="exclude" placeholder="Exclude by ingredients..">
  <input type="submit" value="Search">
  </form>
  
<div id="myNav" class="overlay">
  <div class="overlay-content">
    <a href="#">Profile</a>
    <a href="#">Saved Recipes</a>
    <a href="#">Shopping list</a>
    <a href="#">Household</a>
	<a href="#">Help</a>
  </div>
  
</div>