<?php 
  require_once 'db.inc.php';
  require_once "classes/Templater.class.php";
  require_once "models/user.model.php";
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

  if(isset($_GET["create"])) {
    if($t->logged) header("Location: index.php");
    $t->setTemplate("users/new");
    $t->captcha[0] = rand(1,9);
    $t->captcha[1] = rand(1,9);
  }
  elseif(isset($_GET["all"])) {
    $t->setTemplate("users/all");
    $t->users = $users->all();
  }
  elseif(isset($_GET["edit"])) {
    $t->setTemplate("users/edit");
    if ($t->logged){;
      $t->user = $users->getById($_SESSION["user_id"]);
    } else{
      $t->setTemplate("index");
      $error = ["You must login to access your personal info"];
      $t->render($error);
    }
  }
  elseif(filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)) {
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


  if (isset($_POST["method"])) {
    $method = $_POST["method"];
    $t->setTemplate("index");

    switch ($method) {
      case 'edit':
        $users->update($_POST["name"], $_POST["address"], $_POST["email"], $_SESSION["user_id"]);
        break;
      default:
        break;
    }
  } 



  /* Fin du code de récupération des données */

  
  $t->render();
?>