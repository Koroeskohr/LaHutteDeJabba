<?php 
  require_once 'helpers.php';
  require_once 'db.inc.php';
  require_once 'classes/cart.class.php';
  require_once 'models/product.model.php';
  require_once 'models/order.model.php';

  sec_session_start();

  if(login_check($db)) {
    $orders = new Order($db);
    $orders->create();
  }
  else {
    header("Location: index.php");
  }


 ?>