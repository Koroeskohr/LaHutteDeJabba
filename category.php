<?php 
  include_once 'db.inc.php';
  require_once("classes/Templater.class.php");
  require_once("models/category.model.php");
  require_once("models/product.model.php");
  require_once("helpers.php");
  
  sec_session_start();

  try {
    $t = new Templater("category");// A REMPLIR SELON LA PAGE
  } catch (Exception $e) {
    echo "Error : ".$e->getMessage();
  }

  /* Placer le code de récupération de données ici */
  $categories = new Category($db);
  $products = new Product($db);
  
  
  if (login_check($db)) $t->logged = true;


  
  //routing
  if(isset($_GET["create"])) {
    $t->setTemplate("categories/new");
  } 
  elseif (isset($_GET["edit"]) && isset($_GET["id"])) {
    $t->setTemplate("categories/edit");
    $t->id = purify($_GET["id"]);
    if(!$t->category = $categories->getById($t->id)) throw new Exception("Cette catégorie n'existe pas");
  }
  elseif(isset($_GET["all"])) {
    $t->setTemplate("categories/all");
    $t->categories = $categories->all();
  }
  elseif(isset($_GET["destroy"]) && isset($_GET["id"])){
    $t->setTemplate("categories/all");
    $t->categories = $categories->all();
    $categories->destroy($_GET["id"]);

  }
  elseif(isset($_GET["id"])) {
    $t->setTemplate("categories/category");
    $t->id = $_GET["id"];
    $t->category = $categories->getById($_GET["id"]);
    $t->products = $categories->getProducts($_GET["id"]);

  }


  //execution des fonctions
  if (isset($_POST["method"])) {
    $method = $_POST["method"];
    $t->setTemplate("index");

    switch ($method) {
      case 'create':
        $categories->create($_POST["name"]);
        header("Location: index.php");
        break;
      case 'edit':
        $categories->update($_POST["name"], $_POST["id"]);
        header("Location: index.php");
        break;
      default:
        break;
    }
  } 


  /* Fin du code de récupération des données */

  $t->render();
?>