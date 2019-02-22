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
