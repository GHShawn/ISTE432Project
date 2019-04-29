<?php
define('ROOT','assets/php/');
include_once(ROOT . 'business/IngredientManager.class.php');

$ingredients= $_POST['ingredients'];
if($ingredients!=null){
$str_arr = explode (",", $ingredients);  
print_r($str_arr); 
}

$exclude= $_POST['exclude'];
if($exclude !=null){
$str_arr1 = explode (",", $exclude);  
print_r($str_arr1); 
}

$manager = new IngredientManager();
$igs = $manager->searchIngredients("apple");
echo json_encode($igs);

?>
