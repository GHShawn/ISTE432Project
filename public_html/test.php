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

$test1 = new IngredientManager();

//TEST 1 ( Adding Into Shopping List )
$result1 = $test1->insertShoppingList('Omelette in a Mug');

//TEST 2 ( Purchasing the shopping List into Inventory Table)
$result2 = $test1->purchaseShoppingList();
//
////echo json_encode($result, JSON_PRETTY_PRINT);
//echo json_encode($result, JSON_PRETTY_PRINT);


$test = new RecipeManager();
///getALL Recipes
$result = $test->CallAPI("get",$test->createRecipeAPIcall());
//echo $result;
//$json = json_decode($result, true);
//$food = $test->APIRecipesParser($json);
//echo json_encode($food, JSON_PRETTY_PRINT);
//$test->addRecipetoSavedJSON("Gnocchi Cream Soup");


//get IndividualRecipe
$result = $test->CallAPI("get",$test->grabRecipeData(513654));
//echo $result;
$json = json_decode($result,true);
$food = $test->APIRecipeParser($json);
//echo json_encode($food, JSON_PRETTY_PRINT);

//
?>
