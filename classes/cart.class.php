<?php 

class Cart
{
  public function Cart(){}

  static function add($id){
    array_push($_SESSION["cart"], $id);
  }

  static function remove($id){
    $i = array_search($id, $_SESSION["cart"]);
    if($i != NULL) unset($_SESSION["cart"][i]);
  }

  static function listElements(){
    $items = [];
    foreach ($_SESSION["cart"] as $value) {
      if(!isset($items[$value])) $items[$value] = 1;
      else $items[$value] += 1;
    }

    return $items;
  }
}

 ?>