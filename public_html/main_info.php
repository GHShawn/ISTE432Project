<?php
/**
 * Created by PhpStorm.
 * User: tenzinkhedup
 * Date: 2019-04-27
 * Time: 19:21
 */
define('ROOT','assets/php/');
include_once(ROOT . 'business/RecipeManager.php');
include_once(ROOT . 'business/IngredientManager.class.php');
include_once(ROOT . 'models/User.php');
session_start();
function createDetailPage()
{
	$div = '<!-- Page Content -->
<div class="container">

  <!-- Portfolio Item Heading -->
  <h1 class="my-4">RecipeName: 
    <small>Cheese Cake</small>
  </h1>

  <!-- Portfolio Item Row -->
  <div class="row">

    <div class="col-md-8">
      <img class="img-fluid" src="http://placehold.it/750x500" alt="">
    </div>

    <div class="col-md-4">
      <h3 class="my-3">Recipe Description</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
      <h3 class="my-3">Recipe Ingredients</h3>
      <ul>
        <li>Lorem Ipsum</li>
        <li>Dolor Sit Amet</li>
        <li>Consectetur</li>
        <li>Adipiscing Elit</li>
      </ul>
    </div>

  </div>
  <!-- /.row -->

  <!-- Related Projects Row -->
  <h3 class="my-4">Recipe Instruction</h3>


</div>
<!-- /.container -->';
	echo $div;
	
}
function createcard($img, $name, $used, $missused, $id)
{
    $div = '
        <div class="col-sm-3 col-md-3 col-lg-3 mt-4" style="float:left">
                <div class="card">
                    <img class="card-img-top" style="object-fit: cover" src="'. $img . '">
                    <div class="card-block"  style="height: 190px">
                        <h6 class="card-title mt-3 center" style="padding:5%;text-align: center;height:65px">' . $name . '</h6>
                        <hr>
                        <div class="meta" style="text-align: center">
                            <p style="font-size: 10px">Used Ingredients: ' . $used .'</p>
                            <p style="font-size: 10px">Missed Ingredients: '. $missused .'</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-secondary float-left btn-sm" value="'.$id.'">Save Recipe</button>
                        <button class="btn btn-secondary float-right btn-sm" value="'.$id.'" onclick="modal('.$id.')">View Recipe</button>
                    </div>
                </div>
              
            </div>';

    return $div;
}

function buildrec($output){
    echo "<div class='row'>";
    foreach($output as $key=>$value){
        $img = $value['RecipeImage'];
        $used = $value['IngredientsUsedCount'];
        $missued = $value['MissedIngredientsCount'];
        $id = $value['RecipeID'];
        $name = $value['Title'];

        $div = createcard($img,$name,$used,$missued,$id);
        echo $div;
    }
    echo "</div>";

}

function buildsaved($output){
    echo "<div class='row'>";

    foreach ($output as $value) {
        $img = $value[0]['RecipeImage'];
        $used = $value[0]['IngredientsUsedCount'];
        $missued = $value['MissedIngredientsCount'];
        $id = $value['RecipeID'];
        $name = $value['Title'];

        $div = createcard($img,$name,$used,$missued,$id);
        echo $div;
    }
//    foreach($output as $key=>$value){
//        $img = $value['RecipeImage'];
//        $used = $value['IngredientsUsedCount'];
//        $missued = $value['MissedIngredientsCount'];
//        $id = $value['RecipeID'];
//        $name = $value['Title'];
//
//        $div = createcard($img,$name,$used,$missued,$id);
//        echo $div;
//    }
    echo "</div>";

}

$test1 = new IngredientManager();

if (isset($_POST['action']) && $_POST['action'] == 'Order') {
    // user clicked order
    $test1 ->purchaseShoppingList();
}

//
////$result = $test1->insertShoppingList('Smoked Salmon Scrambled Eggs');
//$result = $test1->purchaseShoppingList();
//
////echo json_encode($result, JSON_PRETTY_PRINT);
//echo json_encode($result, JSON_PRETTY_PRINT);
$test = new RecipeManager();
///getALL Recipes
$result = $test->CallAPI("get",$test->createRecipeAPIcall());
//echo $result;
$json = json_decode($result, true);
$food = $test->APIRecipesParser($json);
//echo json_encode($food, JSON_PRETTY_PRINT);
//get IndividualRecipe
$result = $test->CallAPI("get",$test->grabRecipeData(513654));
//echo $result;
$json = json_decode($result,true);
//$food = $test->APIRecipeParser($json);
//$j = json_encode($food, JSON_PRETTY_PRINT);
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<script src="assets/js/javascript.js"></script>
<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<!-- jQuery Modal -->
<!-- bootstrap -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
<script>
    var bsModal = $.fn.modal.noConflict();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>
<body>
<?php
    $userId = null;
    $userEmail = null;
    $userName = null;
    if (isset($_SESSION["user"])) {
        $user = $_SESSION['user'];
        $arr = $user->getSome();
        $userId = $arr["id"];
        $userEmail = $arr['email'];
        $userName = $arr['username'];
    }
?>
<div id="showRecipe" class="modal">
      <?php
      echo createDetailPage();
      ?>
</div>
<div id="inventory" class="modal">
  <p>This is your inventory.</p>
  <div>
      <?php
      $test1 = new IngredientManager();
      echo $test1->printInventoryTable();
      ?>
  </div>
    <a href="#" rel="modal:close">Close</a>

</div>

<div id="shopping" class="modal">
  <p>Thanks for clicking. This is your shopping list.</p>
    <div>
        <?php
        $test1 = new IngredientManager();
        echo $test1->printShoppingTable();
        ?>
    </div>
    <form method="POST" action="main_info.php">
        <input type="submit" name="action" value="Order"/>
    </form>
  </br>
</div>

<div id="profile" class="modal">
    <p><strong>Thanks for clicking. This is your profile.</strong></p>
    <p><STRONG>Name:</STRONG> <?php echo $userName ?></p>
    <p><STRONG>Email: </STRONG> <?php echo $userEmail ?> </p>
    <p><STRONG>User Id:</STRONG> <?php echo $userId ?></p>
  <a href="#" rel="modal:close">Close</a>
</div>

<div id="help" class="modal">
  <p>Thanks for clicking. This is your help section.</p>
  <a href="#" rel="modal:close">Close</a>
</div>

<div class="topnav">
  <img class="logo" src="assets/images/logo.png" alt="logo">
  <a href="#inventory" rel="modal:open">Inventory</a>
  <a href="#shopping" rel="modal:open">Shopping List</a>
  <span style="font-size:30px;cursor:pointer;float:right;margin-right:20%;margin-top:0.5%" onclick="openNav()"><i class="far fa-2x fa-user-circle"></i></span>
</div>

<div id="myNav" class="overlay">
  <div class="overlay-content">
    <a href="#profile" rel="modal:open">Profile</a>
	  <a href="#help" rel="modal:open">Help</a>
  </div>
 </div>

<img class="display" src="assets/images/d1.jpg" alt="d1">

<div class="mainDiv">
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'RecommandRecipe')">Recommended Recipe</button>
  <button class="tablinks" onclick="openCity(event, 'SavedRecipe')">Saved Recipe</button>
</div>

<div id="RecommandRecipe" class="tabcontent">
  <h3>Recommended Recipe</h3>
  <div class="container">
  <?php
    buildrec($food);
  ?>
  </div>
</div>

<div id="SavedRecipe" class="tabcontent">
  <h3>Saved Recipe</h3>
    <?php
    $data = $test->addRecipetoSavedJSON("Gnocchi Cream Soup");

    buildsaved($data);
    ?></div>
</div>

</div>
</body>
</html>
