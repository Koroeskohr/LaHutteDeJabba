<?php 
  require_once 'db.inc.php';
  require_once "classes/Templater.class.php";
  require_once 'models/review.model.php';

  sec_session_start();

  $reviews = new Review($db);


  /* Placer le code de récupération de données ici */
  if(isset($_POST["stars"], $_POST["product"]) && login_check($db)) {
    $reviews->create($_POST["stars"], $_SESSION["user_id"], $_POST["product"]);
    header("Location: product.php?id=".(int)$_POST['product']);
  }
  else {
    header("Location: index.php?error=1");
  }

?>