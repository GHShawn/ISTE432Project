<!DOCTYPE html>
<html>
<head>
    <title>Recipe</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="assets/js/javascript.js"></script>
</head>
<body>

<span style="font-size:30px;cursor:pointer;float:right;margin-right:5%;margin-top:1.5%" onclick="openNav()"><i class="far fa-2x fa-user-circle"></i></span>



<div id="title">
    <img class="logo" src="assets/images/logo.png" alt="logo">
</div>


<form action="/action_page.php" method="post">
    <input type="text" placeholder="Search by ingredients..">
    <input type="submit" name="button" value="Add">
    <input type="text" placeholder="Exclude by ingredients..">
    <input type="submit" value="Delete">
    <input type="submit" value="Search">
</form>

<div class="display"><img src="assets/images/d1.jpg" alt="d1"></div>
<div id="myNav" class="overlay">
    <!--<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a><-->
    <div class="overlay-content">
        <a href="#">Profile</a>
        <a href="#">Saved Recipes</a>
        <a href="#">Shopping list</a>
        <a href="#">Household</a>
        <a href="#">Help</a>
    </div>

</div>
<div class="recipeCategory"><img src="assets/images/cr1.jpg" alt="cr1"><p>Chicken Recipe</p></div>
<div class="recipeCategory"><img src="assets/images/br1.jpg" alt="br1"><p>Beef Recipe</p></div>
<div class="recipeCategory"><img src="assets/images/sr1.jpeg" alt="sr1"><p>Seafood Recipe</p></div>
<div class="recipeCategory"><img src="assets/images/vr1.jpg" alt="vr1"><p>Vegetable Recipe</p></div>

<div class="Recommend">
    <h1>Daily Recommend Recipes</h1>
    <div class="RecommendRecipe"><img src="assets/images/rr1.jpg" alt="rr1"><p>Roboto has a dual nature. It has a mechanical skeleton and the forms are largely geometric. At the same time, the font features friendly and open curves. </p></div>
    <div class="RecommendRecipe"><img src="assets/images/rr2.jpg" alt="rr2"><p>Roboto has a dual nature. It has a mechanical skeleton and the forms are largely geometric. At the same time, the font features friendly and open curves. </p></div>
    <div class="RecommendRecipe"><img src="assets/images/rr3.jpg" alt="rr3"><p>Roboto has a dual nature. It has a mechanical skeleton and the forms are largely geometric. At the same time, the font features friendly and open curves. </p></div>
</div>
</body>
</html>
