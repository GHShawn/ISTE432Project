<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require "dbinfo.php";
include_once dirname(__FILE__) . '/../models/User.php';

class IngredientManager {
    private $conn = NULL;
    public static $error = NULL;

    function __construct()
    {
        $conn = pg_connect(DB_HOST . ' ' . DB_PORT . ' ' . DB_DATABASE . ' ' . DB_USERNAME . ' ' . DB_PASSWORD)
        or die("Could not connect to server\n");
        $this->conn = $conn;
    }

    function searchIngredients($ingredient) {
        $query = 'SELECT ingredient_id, ingredient_name FROM inventory_database WHERE ingredient_name LIKE $1';
        $stmt = pg_prepare($this->conn, "getIng", $query);
        $result = pg_execute($this->conn, "getIng", array('%' . $ingredient . '%')); //array($user, encryptPassword($pass)));
        $igs = array();
        while ($row = pg_fetch_row($result)) {
            $igs[] = $row[1];
        }
        return $igs;
    }

    function searchIngredientsByIds($ids = array()) {
        $query = 'SELECT ingredient_id, ingredient_name FROM inventory_database WHERE ingredient_id IN $1';
        $stmt = pg_prepare($this->conn, "getIng2", $query);
        $result = pg_execute($this->conn, "getIng21", array($ids)); //array($user, encryptPassword($pass)));
        $igs = array();
        while ($row = pg_fetch_row($result)) {
            $igs[] = $row[1];
        }
        return $igs;
    }

}