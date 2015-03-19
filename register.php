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
  ){
    $users->create($_POST["name"], $_POST["address"], $_POST["email"], $_POST["password"]);
    $t->setTemplate("index");
    $flash = ["Votre compte a bien été créé. Veuillez vérifier votre mail pour l'activer"];
    $t->render($flash);


    /// TODO : envoyer un mail pour activer le compte. rajouter une colonne en BDD activé ou non.
  }
  else {
    $t->setTemplate("index");
    $error = ["Error in the register form, fill in the blanks correctly"];
    $t->render($error);
  }

?>