# ProjectDocumentation 

##  Team Members and Roles 
---
**Tenzin**: Back-end

**LinJian Chen**: Database

**Shunyong Weng**: Front-end 

**Winston Chang**: Back-end

## Background
---

Currently, there are refrigerators that have the capability to track the contents within itself. Their smart capabilities allow interfacing with the user to find out what food they have left and generate a shopping list if necessary. In addition, they are able to browse available recipes and broadcast instructions to the user.

Some smart refrigerators have an app that allows the user to utilize the same features the refrigerators provide from their phone

These refrigerators are able to fetch recipes and aid the user in its creation. The user is able to select a recipe, and the refrigerator can determine the availability of food needed for the recipe. If no food is available, a prompt to the user will ask if it should be placed in a shopping list, or potentially ordered from Amazon. Otherwise, the refrigerator can display the steps to the recipe in order.

They have the capability to share the recipes among family members, or social media.

## Project Description
---

We plan to design a more accessible application for people to utilize which will address their eating habits through the use of their smartphone. Consumption is a market that will never fail, specifically food consumption. Our goal is to create our application to become a tool for everyone to use. Whether it's someone who is a parent or someone who is a student at the college.

## Project Requirements
---

* Manual entry of what the user has in their refrigerator and kitchen, in terms of food ingredients, can be performed to search for food recipes that consist of what ingredients the user has. This search will be powered by a food recipe database API (see _Data Sources_ below). By utilizing the API, this will not only prevent misspellings during entry but provide the user a greater output of what food recipes he/she chooses to follow.

* As the application will also suggest food recipes for the user to follow for the future, as long as the user has part of the ingredients required. Ingredients that the user doesn’t have, will be entered in on a shopping list for the user to either use for the next time he/she goes grocery shopping. A possible feature may be that the needed ingredients can be auto-ordered online to save the user time.

* Besides providing users recipes, it will provide them with a tool to create a weekly organized meal prep for them to follow. For college students and parents, this a very valuable tool for them to utilize as time is always in the essence.

* Other attributes, that the application will take into account consist of “cooking duration” (how much time the user wants to set aside to cooking?), “meal prep” (how many servings of that food the user wants?), “nutritional goals” (how healthy the user wants their meal to be?), “allergies” (what food ingredient the user is allergic to?), “type of cuisine” (what type of food the user wants to make?).

* To add a social aspect to the application, the user can share their favorite recipes to others that they are connected to. Users may also potentially customize given recipes and post it themselves for others to view and follow.

## Business Rules
---

* A user with any food allergies will receive recipes that exclude the allergies.
* A user with ingredients in their inventory will recieve recipes that include any amount of those ingredients. 
* A user will receive recipes that he/she may not have all the ingredients to. 
* A user will receive the option to add any of the ingreidents that they are missing to their shopping list. 
* A user does not need to record any ingredients that has been labeled as bought on their shopping list. 
* A user will recieve a recipe of the day for the exposure for the future. 

* A recipe will have what ingredients are required as well as the cooking instructions. 
* A recipe will not provide any visualization regarding cooking instructions. 
* A recipe cannot be labeled as started without the user having all the required ingredients. 
* We can offer any recipes to the user as long as they have any the required quantity of the ingredients recorded in their inventory. 

## Technologies Used 
---
The application will be developed in Javascript, HTML, CSS, JQuery, API, PHP. 

## Timeline
---

What we need to get done. 

Back End - 

	* Working on the proxy and integrating the external API. ( By March 3, 2019) 
	* Working on the internal API. ** working with Database. ( By March 3, 2019) 
	
	

Front End - 

	* Potential Web Design for how the website will look.  ** completed 
	* Improving Web Design for how it looks. ( By March 3, 2019) 
	* Determining the functionalities required for the project.  **working with BackEnd

Database - 

	* Creating the foundation of all the database table required for the internal API. ( By March 1, 2019) 
	* Making any improvements required for the table. Any changes in the attributes/table. 

[Timeline Share Link](https://drive.google.com/open?id=1g-By5vYxMUW3bw_UL-sadLKzTPoUb330jXX7bXr6h2o)

## Layering 
Presentation - 

* Index.php - Well designed UI to display user login page and detailed about the recipe.
* RecipeDetail.php - Displays the user the specific recipe selected. 
* RecipeList.php - Displays the possible recipes the user can work on. 
* ShoppingList.php - Display the ingredients that are needed to be purchased for any potential recipe.

Application - 

* Authentication.class - Takes in the input from the presentation and sends it to the Business layer which will allow logins of the different users. 
* RecipeDetail.class - Every user will have differently detailed about the recipe information. Grabs the data from the RecipeAPI.class
	
Business - 

* Authentication.class - Grab data from the MySQL table ( ‘authentication’) to verify loggings. 
* RecipeAPI.class - Interacts with the API. Will grab the list of recipes one can make with the given ingredients and will grab the details related to the chosen recipe. Will utilize the data from the tables in the MySQL - inventory table. 

Data - 

* MySQL.class - Obtained MySQL database class allowing the application to connect with the database and it also takes in the SQL statement for retrieving or updating information from the database.
* ExceptionHandler.class - It will handling the exception for SQL statement errors and connection error. 
	
## Exceptions
* Database connectivity error
  - User will not know or be informed of this error
  - User will be acknowledge of a downtime or internal error, no specifics
* When API returns recipe whose ingredients does not match user's request
  - Determine why the recipe shows up
  - Calculate if user should see recipe anyways
* API doesn't work?
  - Declare downtime
* Ingredient does not exist
  1) Determine API behavior for invalid ingredient
  2) Likely - ignore ingredient and continue as normal
  3) Notify user of invalid ingredient (sanitation?)
  
```

function createAPIurl($array = Array()){
    $url = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/findByIngredients?number=20&ranking=1&fillIngredients=true&ingredients=";

    foreach ($array as $v) {
        $v = str_replace(" ", "+", $v);
        $url .= $v . "%2C";
    }

    $url = substr($url,0, -3);
    return $url;

}
$array = Array("apples","flour","sugar","beef", "chicken","rice","salt","carrots","celery","apple cider","baking soda","fish","eggs","milk","garlic","lemon juice","corned beef","butter","heavy cream");


function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
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

    $headers = array (
    "X-RapidAPI-Key: 9c7d878d29msh838715c2b27adfbp132ac0jsn0536b7f5db0f" );
    curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($curl);


    curl_close($curl);

    return $result;
}

$json = json_decode(CallAPI("get",createAPIurl($array)), true);
//var_dump($json);
//var_dump(json_decode($output));
function parser($output){
    $food = array();
    for ($i=0;$i < count($output); $i++) {
//        $usedingred = array();
        $missedingred = array();
        for ($j=0; $j < count($output[$i]['usedIngredients']);$j++) {
            $item = $output[$i]['usedIngredients'][$j];
            $usedingred[$item["name"]] = array(
                "IngredientID" => $item["id"],
                "Amount" => trim($item["amount"] . " " . $item["unitLong"]),
                "Detail" => $item["originalString"]
            );


        }

        for ($j=0; $j < count($output[$i]['missedIngredients']);$j++) {
            $missedingred[] = $output[$i]['missedIngredients'][$j]["name"];
        }

        $food[$output[$i]['title']] = array(
            "RecipeID" => $output[$i]['id'],
            "RecipeImage" => $output[$i]['image'],
            "IngredientsUsed" => $usedingred,
            "MissedIngredients" => $missedingred
        );
    }
    return $food;
}

```
## Design pattern
---

### Composite Pattern
  * We use the composite pattern to implement the Recipe and Ingredient as the same root object
```php
interface IFood {
    
}

class Ingredient implements IFood {
    private $id;
    private $name;
}

class Recipe implements IFood {
    private $id;
    private $name;
    private $ingredients = array();
}
```

### Proxy Pattern
* We use the proxy pattern to provide an interface for an external API to our clients
* Rather than have our client interact with the extern API directly, they would interact using our API
* If we ever want to use a different API, we can simply modify our proxy, and the client
  doesn't have to change anything

```php
class RecipeApiProxy {
    function getRecipes();
    function searchRecipesByIngredients($ingredients, $exclude);
}
```

### MVC Pattern
 * We will implement the MVC pattern, but no concrete structure has been suggested as of this time

```
├── api     -- Controller   - Controls the data flow of the model, and updates the view when the data changes
├── models  -- Model        - Provides the structure of the data
└── www     -- View         - Provides the view of the model to the client
```

## Other Classes
```php
// identity of our users in the database
class User {
    private $id;
    private $email;
    private $username;
}
// Shopping structure
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
```

## Refactor
* Our database initialisation script has been updated to work with Postgres Database
* Database functions in [UserManager.class.php](https://github.com/Txd5857/ISTE432Project/blob/master/business/UserManager.class.php) reflected to work with Postgres
* We switched the API call to a different API url for when grabbing the instructrions for the recipe. 
* The original API call just got a paragraph of what the instructions are, while the new API call will grab the breakdown of the instructions which includes step description, the duration of the step, ingredients required, and equipment required. 

## Testing
* we updated IngredientTest and RecipeTest
```php
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
?>
```


```php
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
?>
```
## Deployment and Packaging

