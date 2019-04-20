<?php

use PHPUnit\Framework\TestCase;

class IngredientTest extends TestCase {
    public function testCanBeCreated() {
        $this->assertInstanceOf(
            Ingredient::class,
            new Ingredient(123, "testIngredient")
        );
    }

    public function testCannotBeCreatedFromInvalidParameters() {
        $this->assetInstanceOf(Ingredient::class, $test = new Ingredient("asdf", "asdf"));
        $this->assertIsInt($test->getId());
        $this->assetIsString($test->getName());
    }
}