<?php

class ShoppingList {
    private $id;
    private $user;
    private $items = array();
}

class ShoppingListItem {
    private $id;
    private $list_id;
    private $ingredient;
}