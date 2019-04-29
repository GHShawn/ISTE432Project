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

function createcard($img, $name, $used, $missused, $id)
{
    $div = '
        <div class="col-sm-3 col-md-3 col-lg-3 mt-4" style="float:left">
                <div class="card" style="max-height: 60%">
                    <img class="card-img-top" style="object-fit: cover" src="'. $img . '">
                    <div class="card-block">
                        <h6 class="card-title mt-3 center" style="padding:5%;text-align: center">' . $name . '</h6>
                        <hr>
                        <div class="meta" style="text-align: center">
                            <p style="font-size: 10px">Used Ingredients: ' . $used .'</p>
                            <p style="font-size: 10px">Missed Ingredients: '. $missused .'</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small>View Recipe</small>
                        <button class="btn btn-secondary float-right btn-sm" value="'.$id.'">show</button>
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

$test1 = new IngredientManager();
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
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<div class="container">
    <?php
    buildrec($food);
    ?>
</div>
</body>
</html>

