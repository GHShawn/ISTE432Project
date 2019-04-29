<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

include_once(ROOT . 'business/RecipeManager.php');


class IngredientManager {
    private $db;
    private $conn = NULL;
    public static $error = NULL;
    public $addIngredient = array();

    function __construct()
    {
        $conn = pg_connect(DB_HOST . ' ' . DB_PORT . ' ' . DB_DATABASE . ' ' . DB_USERNAME . ' ' . DB_PASSWORD)
        or die("Could not connect to server\n");
        $this->conn = $conn;
    }

    function insertShoppingList($name){
        $arr = $this -> getMissingIngArr($name);

        $query = 'insert into shopping_list(ingredient_id, ingredient_name,user_id) values ($1, $2, $3) ';
        $id = "";
        $uid = 6;
        $name = "";
        $stmt = pg_prepare($this->conn,"dd", $query);

        for ($i=0;$i<count($arr);$i++) {
            $id = $arr[$i]["ID"];
            $name = $arr[$i]["name"];
            $result = pg_execute($this->conn, "dd", array($id, $name,$uid));
        }
        $row = pg_fetch_row($result);
        pg_close($this->conn);
        echo $row['0'];
    }

    function purchaseShoppingList(){
        $query = 'SELECT ingredient_id,ingredient_name FROM shopping_list';
        $result = pg_query($this->conn, $query);
        $count = pg_num_rows($result);
        for ($i=0; $i <= count($count); $i++){
            $row = pg_fetch_row($result);
            $this->addIngredient[$i] = array(
                "ID" => $row[0],
                "Name" => $row[1]
            );
        }
        $query1 = 'insert into inventory_database(ingredient_id, ingredient_name) values ($1, $2) ';
        $stmt = pg_prepare($this->conn,"ee", $query1);

        for ($i=0;$i<count($this->addIngredient);$i++) {
            $id = $this->addIngredient[$i]["ID"];
            $name = $this->addIngredient[$i]["Name"];
            $result = pg_execute($this->conn, "ee", array($id, $name));
        }

        $query2 = 'delete from shopping_list where user_id = 6';
        $result = pg_query($this->conn, $query2);


        pg_close($this->conn);
        echo $row['0'];

    }

    function EntryExist(){

    }

    function getMissingIngArr($name){
        $arr = $this -> getMissingIng($name);
        $misarr = array();
        for ($i=0; $i < count($arr); $i++){
            $misarr[$i] = array(
                "name" => $arr[$i]['Name'],
                "ID" => $arr[$i]['IngredientID']
            );
        }
        return $misarr;
    }

    function getMissingIng($name){
        $rm = new RecipeManager();
        $result = $rm->CallAPI("get",$rm->createRecipeAPIcall());
        $json = json_decode($result, true);
        $food = $rm->APIRecipesParser($json);

        $missinging = $food["$name"]['MissedIngredients'];

        return $missinging;
    }



}