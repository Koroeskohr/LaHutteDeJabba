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
  $user = new User($db);

  if(isset($_GET["id"])) {
    $t->id = $_GET["id"];
    $t->debug["getbyid"] = $user->getBy("id",$t->id);

  }

  $t->debug["getby_name"] = $user->getByName("Victor Viale");
  $t->debug["email"] = $user->getBy("email", "viale.victor@gmail.com");

  $t->allUsers = $user->all();


  /* Fin du code de récupération des données */

  
  $t->render();
?>