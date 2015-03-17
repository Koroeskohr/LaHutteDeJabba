<?php 
  include 'db.inc.php';
  require_once("classes/Templater.class.php");
  require_once("models/user.model.php");
  require_once 'helpers.php';

  sec_session_start();
  
  try {
    $t = new Templater("user");// A REMPLIR SELON LA PAGE
  } catch (Exception $e) {
    echo "Error : ".$e->getMessage();
  }

  /* Placer le code de récupération de données ici */
  $users = new User($db);
  

  if (login_check($db)) $t->logged = true;
  

  /*

  elseif(isset($_GET["all"])) {
    $t->setTemplate("products/all");
    $t->products = $products->all();
  }


   */
  if(isset($_GET["create"])) {
    $t->setTemplate("users/new");
  }
  elseif(isset($_GET["edit"])) {
    $t->setTemplate("users/edit");
    if ($t->logged){;
      $t->user = $users->getById($_SESSION["user_id"]);
    } else{
      header("Location: /index.php?error=1");
    }
  }
  elseif(isset($_GET["id"])) {
    $t->setTemplate("users/user");
    $t->id = $_GET["id"];
    $t->user = $users->getById($_GET["id"]);
  } 
  
  if(empty($_GET)){
    if($t->logged){
      $t->setTemplate("users/user");
      $t->user = $users->getById($_SESSION["user_id"]);
    } else {
      header("Location: index.php");
    }
  }
  /// TODO


  if (isset($_POST["method"])) {
    $method = $_POST["method"];
    $t->setTemplate("index");

    switch ($method) {
      case 'create':
        $users->create($_POST["name"], $_POST["address"], $_POST["email"], $_POST["password"]);
        header("Location: index.php");
        break;
      case 'edit':
        $users->update($_POST["name"], $_POST["address"], $_POST["email"], $_SESSION["user_id"]);
        header("Location: index.php");
        break;
      default:
        break;
    }
  } 



  /* Fin du code de récupération des données */

  
  $t->render();
?>