<?php

use PHPUnit\Framework\TestCase;

class RecipeTest extends TestCase {
    public function testCanBeCreated() {
        $this->assertInstanceOf(
            Recipe::class,
            new Recipe(123, "testRecipe")
        );
    }

    public function testCannotBeCreatedFromInvalidParameters() {
        $this->assetInstanceOf(Recipe::class, $test = new Recipe("asdf", "asdf"));
        $this->assertIsInt($test->getId());
        $this->assetIsString($test->getName());
    }

    public function testCanAddIngredients() {
        $recipe = new Recipe(123, "testRecipe");
        $this->assertTrue($recipe.addIngredient(new Ingredient(321, "testIngredient")));
    }
}