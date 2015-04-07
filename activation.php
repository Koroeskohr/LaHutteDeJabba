<?php 
  require_once 'db.inc.php';
  require_once("models/user.model.php");
  require_once("classes/Templater.class.php");
  require_once 'helpers.php';

  sec_session_start();

  $users = new User($db);
  $t = new Templater("activation");


  $t->logged = login_check($db);

  if(isset($_GET["key"], $_GET["id"])
    && !empty($_GET["id"])
    && is_string($_GET["key"]) && !empty($_GET["key"])
  ){
    $account = $users->getById($_GET["id"]);
    $key = hash("sha256", SALT.$account["name"]); //pas tres bien
    if($key = $_GET["key"]){
      $users->setActivated($_GET["id"]);
      $t->setTemplate("index");
      $flash = ["Your account has been successfully activated."];
      $t->render($flash);
    }
  }
  else {
    $t->setTemplate("index");
    $error = ["Wrong key"];
    $t->render($error);
  }

?>