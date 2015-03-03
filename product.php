<?php 
  include 'db.inc.php';
  require_once("classes/Templater.class.php");
  require_once("models/product.model.php");
  
  try {
    $t = new Templater("product");// A REMPLIR SELON LA PAGE
  } catch (Exception $e) {
    echo "Error : ".$e->getMessage();
  }


  /* Placer le code de récupération de données ici */
  $products = new Product($db);

  if(isset($_GET["id"])) {
    $t->setTemplate("products/product");
    $t->id = $_GET["id"];
    $p = $products->getById($t->id);
  }
  elseif (isset($_POST["_method"])) {
    $method = $_POST["_method"];

    switch ($method) {
      case 'create':
        $products->create($_POST["name"], $_POST["description"], $_POST["category_id"], $_POST["price"], $_POST["amount"]);
        break;
      
      default:
        # code...
        break;
    }
  }
  
  $t->product = $p;


  /* Fin du code de récupération des données */

  
  $t->render();
?>