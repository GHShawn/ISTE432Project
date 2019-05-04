<?php
define('ROOT','assets/php/');
include_once(ROOT . 'business/RecipeManager.php');
include_once(ROOT . 'business/IngredientManager.class.php');
include_once(ROOT . 'models/User.php');

/*
$manager = new IngredientManager();
$igs = $manager->searchIngredients("apple");
echo json_encode($igs);
*/
function createDetailPage($title,$preparation,$servings,$dishType,$instructions)
{
	$div = '<!-- Page Content -->
<div class="container">

  <!-- Portfolio Item Heading -->
  <h1 class="my-4">RecipeName: 
    <small>'. $title .'</small>
  </h1>

  <!-- Portfolio Item Row -->
  <div class="row">

    <div class="col-md-8">
      <h3 class="my-4">Recipe Detail</h3>
      <ul>
        <li>Preparation Minutes: ' .$preparation.'</li>
        <li>Servings: ' .$servings.'</li>
        <li>DishType: ' .$dishType.'</li>
      </ul>
    </div>

  </div>
  <!-- /.row -->
  <!-- Related Projects Row -->
  <h3 class="my-4">Recipe Instruction</h3>';

    $int = 0;
    foreach($instructions as $key=>$value){
        $int +=1;
        $step = '<p>'.$int.'. '.$value['Instruction'].'</p>';
        $div .=$step;
    }
    $div .= '</div>';
	return $div;
	
}
function buildrec($output){
    echo "<div class='row'>";
    foreach($output as $key=>$value){
        $title = $value['Title'];
        $preparation = $value['PreparationMinutes'];
        $servings = $value['Servings'];
        $dishType = $value['DishType'];
        $instructions = $value['Instructions'];

        $div = createDetailPage($title,$preparation,$servings,$dishType,$instructions);
        echo $div;
    }
    echo "</div>";

}
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

<div id="showRecipe">
      <?php
		$test = new RecipeManager();
		$result = $test->CallAPI("get",$test->grabRecipeData($_POST["submit"]));
		$json = json_decode($result,true);
		$food = $test->APIRecipeParser($json);
		echo buildrec($food);
      ?>
</div>

</body>
</html>
