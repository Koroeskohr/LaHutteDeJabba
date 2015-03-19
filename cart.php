<?php 
  require_once 'db.inc.php';
  require_once("classes/Templater.class.php");
  require_once("classes/cart.class.php");
  require_once("models/product.model.php");
  require_once 'helpers.php';

  sec_session_start();
  $url = parse_url($_SERVER["HTTP_REFERER"]);

  if(!login_check($db)){
    $t = new Templater("index");
    $t->setTemplate("index");
    $error = ["You must login to access your cart"];
    $t->render($error);
  } 

  $t = new Templater("Cart");
  $products = new Product($db);
  $t->logged = true;

  if(isset($_GET["add"], $_GET["id"]) && filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)) {
    Cart::add($_GET["id"]);
  }
  elseif (isset($_GET["remove"], $_GET["id"]) && filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)) {
    Cart::remove($_GET["id"]);
  }
  elseif (isset($_GET["list"])) {
    
    $t->setTemplate("cart");
    $items = Cart::listElements();
    $t->cartItems = [];
    foreach ($items as $item => $quantity) {
      $i = new stdClass();
      $i->item = $products->getById($item);
      $i->amount = $quantity;

      $t->cartItems[] = $i;
    }
     
    $t->render();

  }
  


  header("Location: ".$url["path"]."?".$url["query"]);


 ?>