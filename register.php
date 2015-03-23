<?php 
  require_once 'db.inc.php';
  require_once("models/user.model.php");
  require_once("classes/Templater.class.php");
  require_once 'helpers.php';

  $users = new User($db);
  $t = new Templater("register");

  $t->logged = login_check($db);

  if(isset($_POST["email"], $_POST["password"], $_POST["name"], $_POST["address"])
    && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty($_POST["email"])
    && is_string($_POST["name"]) && !empty($_POST["name"])
    && is_string($_POST["address"]) && !empty($_POST["address"])
    && (int)$_POST["captcha"] == (int)$_POST["captcha1"] + (int)$_POST["captcha2"]
  ){
    $t->setTemplate("index");
    if($users->create($_POST["name"], $_POST["address"], $_POST["email"], $_POST["password"])){
      $flash = ["Account created. Verify your account by checking your email"];
    } else {
      $flash = ["Email already used"];
    }
    
    $t->render($flash);

  }
  else {
    $t->setTemplate("index");
    $error = ["Error in the register form, fill in the blanks correctly"];
    $t->render($error);
  }

?>