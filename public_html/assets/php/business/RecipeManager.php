<?php
/**
 * Created by PhpStorm.
 * User: tenzinkhedup
 * Date: 2019-04-27
 * Time: 18:43
 */


ini_set("display_errors", "1");
error_reporting(E_ALL);
require "dbinfo.php";

class RecipeManager
{

    private $conn = NULL;
    public static $error = NULL;
    public $foodarray = array();

    function __construct()
    {
        $conn = pg_connect(DB_HOST . ' ' . DB_PORT . ' ' . DB_DATABASE . ' ' . DB_USERNAME . ' ' . DB_PASSWORD)
        or die("Could not connect to server\n");
        $this->conn = $conn;
    }

    function createIngArray()
    {
        $query = 'SELECT ingredient_name FROM inventory_database';
        $result = pg_query($this->conn, $query);
        while ($row = pg_fetch_row($result)) {
            $this->foodarray[] = $row[0];
        }
        return $this->foodarray;

    }

    function createRecipeAPIcall()
    {
        $this->createIngArray();

        $url = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/findByIngredients?number=15&ranking=2&ignorePantry=true&ingredients=";

        foreach ($this->foodarray as $v) {
            $v = str_replace(" ", "+", $v);
            $url .= $v . "%2C";
        }

        $url = substr($url, 0, -3);
        return $url;
    }

    function CallAPI($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $headers = array(
            "X-RapidAPI-Key: 9c7d878d29msh838715c2b27adfbp132ac0jsn0536b7f5db0f");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);


        curl_close($curl);

        return $result;

    }

    function APIRecipesParser($output)
    {
        $food = array();
        for ($i = 0; $i < count($output); $i++) {
            $missedingred = array();
            $usedingred = array();
            for ($j = 0; $j < count($output[$i]['usedIngredients']); $j++) {
                $item = $output[$i]['usedIngredients'][$j];
                $usedingred[$i] = array(
                    "Name" => $item["name"],
                    "IngredientID" => $item["id"],
                    "Amount" => trim($item["amount"] . " " . $item["unitLong"]),
                    "Detail" => $item["originalString"]
                );
            }

            for ($j = 0; $j < count($output[$i]['missedIngredients']); $j++) {
                $item = $output[$i]['missedIngredients'][$j];
                $missedingred[$j] = array(
                    "Name" => $item["name"],
                    "IngredientID" => $item["id"],
                    "Amount" => trim($item["amount"] . " " . $item["unitLong"]),
                    "Detail" => $item["originalString"]
                );
            }

            $food[$output[$i]['title']] = array(
                "Title" => $output[$i]['title'],
                "RecipeID" => $output[$i]['id'],
                "RecipeImage" => $output[$i]['image'],
                "IngredientsUsedCount" => $output[$i]['usedIngredientCount'],
                "MissedIngredientsCount" => $output[$i]['missedIngredientCount'],
                "IngredientsUsed" => $usedingred,
                "MissedIngredients" => $missedingred
            );
        }
        return $food;
    }

    function getRecipes(){
        $result = $this->CallAPI("get",$this->createRecipeAPIcall());
        $json = json_decode($result, true);
        $food = $this->APIRecipeParser($json);
        return json_encode($food, JSON_PRETTY_PRINT);
    }

    function grabRecipeData($id){
        $url = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/informationBulk?includeNutrition=true&ids=";

        $url .= $id;

        return $url;
    }

    function APIRecipeParser($output){
        $food = array();
        $cuisines = "";
        $instructions = array();
        $nutr = array();
        for ($i = 0; $i < count($output); $i++) {
            for ($j = 0; $j < count($output[$i]['cuisines']);$j++) {
                $item = $output[$i]['cuisines'][$j];
                $cuisines .= $item + ",";
                $cuisines = substr($cuisines, 0, -1);
            }
            for ($j = 0; $j < count($output[$i]['analyzedInstructions'][0]['steps']); $j++){
                $ingredients = array();
                $equipment = array();

                $item = $output[$i]['analyzedInstructions'][0]['steps'][$j];
                $instructions["Step " . $item["number"]] = array(
                    "Instruction" => $item["step"]
                );
                for ($k = 0; $k < count($item["ingredients"]); $k++ ){
                    $ingredients[] = $item['ingredients'][$k];
                }
                for ($l = 0; $l < count($item["equipment"]); $l++ ){
                    $equipment[] = $item['equipment'][$l];
                }
                $instructions["Step " . $item["number"]] = array(
                    "Instruction" => $item["step"],
                    "Ingredients" => $ingredients,
                    "Equipments" => $equipment
                );
//                array_push($instructions["Step " . $item["number"]],$ingredients["e"]);
//                array_push($instructions["Step " . $item["number"]],$equipment);

            }
            for ($j = 0; $j < count($output[$i]["nutrition"]["nutrients"]); $j++){

            }
        $food[$output[$i]['title']] = array(
            "Title" => $output[$i]['title'],
            "PreparationMinutes" => $output[$i]['preparationMinutes'],
            "CookingMinutes" => $output[$i]['cookingMinutes'],
            "Servings" => $output[$i]['servings'],
            "DishType" => $output[$i]['dishTypes'][0],
            "Instructions" => $instructions,
            "Nutriental Information" => $nutr
        );

        }
        return $food;
    }

    function getRecipe(){
        $result = CallAPI("get",createRecipeAPIcall());
        $json = json_decode($result, true);
        $food = APIRecipesParser($json);
        return json_encode($food, JSON_PRETTY_PRINT);
    }

    function addtoShoppingList($id){
        $query = 'insert into shopping_list(username, email,pswd) values ($1, $2, $3) ';

        }

}
?>