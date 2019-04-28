<?php
define('ROOT','assets/php/');
include_once(ROOT . 'business/IngredientManager.class.php');

$manager = new IngredientManager();
$igs = $manager->searchIngredients("apple");
echo json_encode($igs);