<?php 
  include 'db.inc.php';
  require_once("classes/Templater.class.php");
  require_once("models/user.model.php");
  
  try {
    $t = new Templater("user");// A REMPLIR SELON LA PAGE
  } catch (Exception $e) {
    echo "Error : ".$e->getMessage();
  }

  /* Placer le code de récupération de données ici */
  $users = new User($db);


  /*
  
if(isset($_GET["create"])) {
    $t->setTemplate("products/new");
  } 
  elseif (isset($_GET["edit"]) && isset($_GET["id"])) {
    $t->setTemplate("products/edit");
    $t->id = purify($_GET["id"]);
    if(!$t->product = $products->getById($t->id)) die("Ce produit n'existe pas :(");
    $t->categories = $categories->all();
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

   */
  if(isset($_GET["create"])) {
    $t->setTemplate("users/new");
  } 
  if(isset($_GET["id"])) {
    $t->setTemplate("users/user");
    $t->id = $_GET["id"];
    $t->user = $users->getById($_GET["id"]);

  } 


  if (isset($_POST["method"])) {
    $method = $_POST["method"];
    echo "Methode appelée : ".$_POST["method"];
    $t->setTemplate("index");

    switch ($method) {
      case 'create':
        $users->create($_POST["name"], $_POST["address"], $_POST["email"], $_POST["password"]);
        header("Location: index.php");
        break;
      case 'edit':
        $users->update($_POST["name"], $_POST["address"], $_POST["email"], $_POST["id"]);
        header("Location: index.php");
        break;
      default:
        break;
    }
  } 



  /* Fin du code de récupération des données */

  
  $t->render();
?>