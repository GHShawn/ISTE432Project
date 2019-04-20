<?php

class Recipe implements IFood {
    private $id;
    private $name;
    private $ingredients = array();

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function addIngredient(Ingredient $ingredient) {
        array_push($this->ingredients, $ingredient);
        return true;
    }
}