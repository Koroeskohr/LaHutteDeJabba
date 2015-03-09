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
  elseif (isset($_GET["edit"])) {
    $t->setTemplate("products/edit");
    echo "edit";
    if(isset($_GET["id"])){
      echo " id";
      $t->id = purify($_GET["id"]);
    }
  } 
  elseif(isset($_GET["id"])) {
    $t->setTemplate("products/product");
    $t->id = $_GET["id"];
    $p = $products->getById($t->id);
  }


  //execution des fonctions
  if (isset($_POST["method"])) {
    $method = $_POST["method"];
    echo "Methode appelée : ".$_POST["method"];
    $t->setTemplate("index");

    switch ($method) {
      case 'create':
        $products->create($_POST["name"], $_POST["description"], $_POST["category_id"], $_POST["price"], $_POST["amount"]);
        break;
      case 'edit':
        $products->update($_POST["name"], $_POST["description"], $_POST["category_id"], $_POST["price"], $_POST["amount"], $_POST["id"]);
        break;
      default:
        break;
    }
  } 
  
  //$t->setTemplate("index");


  /* Fin du code de récupération des données */

  
  $t->render();
?>