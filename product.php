<?php 
  include 'db.inc.php';
  require_once("classes/Templater.class.php");
  require_once("models/product.model.php");
  require_once("helpers.php");
  
  try {
    $t = new Templater("product");// A REMPLIR SELON LA PAGE
  } catch (Exception $e) {
    echo "Error : ".$e->getMessage();
  }


  /* Placer le code de récupération de données ici */
  $products = new Product($db);

  //routing
  if(isset($_GET["create"])) {
    $t->setTemplate("products/new");
  } 
  elseif (isset($_GET["edit"]) && isset($_GET["id"])) {
    $t->setTemplate("products/edit");
    $t->id = purify($_GET["id"]);
    if(!$t->product = $products->getById($t->id)) die("Ce produit n'existe pas :(");
  }
  elseif(isset($_GET["all"])) {
    $t->setTemplate("products/all");
    $t->products = $products->all();
  }
  elseif(isset($_GET["destroy"]) && isset($_GET["id"])){
    $t->setTemplate("products/all");
    $t->products = $products->all();
    $products->destroy($_GET["id"]);

  }
  elseif(isset($_GET["id"])) {
    $t->setTemplate("products/product");
    $t->id = $_GET["id"];
    $t->product = $products->getById($t->id);
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