<?php 
  include 'db.inc.php';
  require_once("classes/Templater.class.php");
  require_once 'helpers.php';
  
  sec_session_start();
  
  try {
    $t = new Templater("index");// A REMPLIR SELON LA PAGE
  } catch (Exception $e) {
    echo "Error : ".$e->getMessage();
  }
  
  if (login_check($db)) $t->logged = true;

  /* Placer le code de récupération de données ici */
  $t->setTemplate("index");

  /* Fin du code de récupération des données */
  
  $t->render();
?>