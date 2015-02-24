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
    $t->id = $_GET["id"];
    $p = $products->getById($t->id);
  }
  else {
    header("Location:index.php");
  }
  $t->product = $p;


  /* Fin du code de récupération des données */

  
  $t->render();
?>