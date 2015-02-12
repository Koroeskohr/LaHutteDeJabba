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
  $products_by_category = $products->getByCategory(1);
  $t->products = $products_by_category;


  /* Fin du code de récupération des données */

  
  $t->render();
?>