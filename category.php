<?php 
  include 'db.inc.php';
  require_once("classes/Templater.class.php");
  require_once("models/category.model.php");
  require_once("models/product.model.php");

  /* Placer le code de récupération de données ici */
  
  $category = new Category($db);

  if(isset($_GET["all"])){
    try {
      $t = new Templater("categories");// A REMPLIR SELON LA PAGE
    } catch (Exception $e) {
      echo "Error : ".$e->getMessage();
    }

    $t->categories = $category->all();


  } elseif (isset($_GET["id"])) {
    try {
      $t = new Templater("category");// A REMPLIR SELON LA PAGE
    } catch (Exception $e) {
      echo "Error : ".$e->getMessage();
    }


    $t->id = $_GET["id"];
    $c = $category->getById($t->id);

    $t->category = $category->getById($t->id);

  } 


  /* Fin du code de récupération des données */

  $t->render();
?>