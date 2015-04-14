<?php 
  require_once 'db.inc.php';
  require_once "classes/Templater.class.php";
  require_once 'models/product.model.php';
  require_once 'helpers.php';
  
  sec_session_start();
  
  try {
    $t = new Templater("index");// A REMPLIR SELON LA PAGE
  } catch (Exception $e) {
    echo "Error : ".$e->getMessage();
  }
  
  $products = new Product($db);

  //MISSION 2
  //affichage panier
  //commentaire d'un utilisateur sur un produit
  //note du produit


  if (login_check($db)) $t->logged = true;

  $t->recommandations = $products->getRandom(4);



  /* Placer le code de récupération de données ici */
  $t->setTemplate("index");

  /* Fin du code de récupération des données */
  
  $t->render();
?>