<?php 
  require_once 'db.inc.php';
  require_once("classes/Templater.class.php");
  require_once("models/product.model.php");
  require_once("models/category.model.php");
  require_once("models/review.model.php");
  require_once("models/user.model.php");

  require_once("helpers.php");
  
  sec_session_start();
  
  try {
    $t = new Templater("product");// A REMPLIR SELON LA PAGE
  } catch (Exception $e) {
    echo "Error : ".$e->getMessage();
  }

  if (login_check($db)) $t->logged = true;


  /* Placer le code de récupération de données ici */
  $products = new Product($db);
  $categories = new Category($db);
  $reviews = new Review($db);
  $users = new User($db);

  //routing
  if(isset($_GET["create"])) {
    $t->setTemplate("products/new");
    $t->categories = $categories->all();
  } 
  elseif (isset($_GET["edit"]) && filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)) {
    $t->setTemplate("products/edit");
    $t->id = purify($_GET["id"]);
    if(!$t->product = $products->getById($t->id)) die("Ce produit n'existe pas :(");
    $t->categories = $categories->all();
  }
  elseif(isset($_GET["all"])) {
    $t->setTemplate("products/all");
    $t->products = $products->all();
  }
  elseif(isset($_GET["destroy"]) && filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)){
    $t->setTemplate("products/all");
    $t->products = $products->all();
    $products->destroy($_GET["id"]);

  }
  elseif(filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)) {
    $t->setTemplate("products/product");
    $t->id = $_GET["id"];
    $t->product = $products->getById($t->id);
    $t->reviews = $reviews->getByProduct($t->id);
  }
  else{
    $t->setTemplate("products/all");
    $t->products = $products->all();
  }


  //execution des fonctions
  if (isset($_POST["method"])) {
    $method = $_POST["method"];
    echo "Methode appelée : ".$_POST["method"];
    $t->setTemplate("index");

    switch ($method) {
      case 'create':
        $products->create($_POST["name"], $_POST["description"], $_POST["category_id"], $_POST["price"], $_POST["amount"]);
        header("Location: index.php");
        break;
      case 'edit':
        $products->update($_POST["name"], $_POST["description"], $_POST["category_id"], $_POST["price"], $_POST["amount"], $_POST["id"]);
        header("Location: index.php");
        break;
      default:
        break;
    }
  } 
  
  /* Fin du code de récupération des données */

  
  $t->render();
?>