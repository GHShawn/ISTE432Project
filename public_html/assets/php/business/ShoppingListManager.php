<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require "dbinfo.php";
include_once dirname(__FILE__) . '/../models/User.php';


class ShoppingListManager
{
    private $conn = NULL;
    public static $error = NULL;

    function __construct()
    {
        $conn = pg_connect(DB_HOST . ' ' . DB_PORT . ' ' . DB_DATABASE . ' ' . DB_USERNAME . ' ' . DB_PASSWORD)
        or die("Could not connect to server\n");
        $this->conn = $conn;
    }

    function addToShoppingList(User $user, $quantity, $ingredient_id) {
        $query = 'INSERT INTO shopping_list (ingredient_id, quantity, user_id) VALUES ($1, $2, $3)';
        $stmt = pg_prepare($this->conn, "getIng", $query);
        $result = pg_execute($this->conn, "getIng", array($ingredient_id, $quantity, $user->id)); //array($user, encryptPassword($pass)));
        return $result;
    }

    function removeFromShoppingList(User $user, $ingredient_id) {
        $query = 'DELETE FROM shopping_list WHERE user_id = $1 AND $ingredient_id = $2';
        $stmt = pg_prepare($this->conn, "getIng", $query);
        $result = pg_execute($this->conn, "getIng", array($user->id, $ingredient_id)); //array($user, encryptPassword($pass)));
        return $result;
    }

}