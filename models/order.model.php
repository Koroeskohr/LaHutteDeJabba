<?php 
require_once __DIR__."/../classes/model.class.php";
require_once __DIR__."/../db.inc.php";
require_once __DIR__."/../helpers.php";
require_once __DIR__."/../classes/cart.class.php";

class Order extends Model
{
  /*
    int:id
    int:Users_id
    int:created_at
    bool:packed
    bool:sent
   */

  protected $tableName;
  protected $joinTable;
  protected static $db; 

  function __construct($db)
  {
    $this->tableName = "Orders";
    $this->joinTable = "Orders_products_join";
    static::$db = $db;
  }

  public function create(){
    try {
      static::$db->beginTransaction();
      $q = static::$db->prepare("INSERT INTO $this->tableName (Users_id, created_at, packed, sent) VALUES (:user_id, :created_at, 0, 0);");
      $a = array(
        'user_id' => $_SESSION["user_id"],
        'created_at' => time()
      );
      $q->execute($a);

      $cart = Cart::listElements();
      $order_id = static::$db->lastInsertId();

      foreach ($cart as $product => $qty) {
        static::$db->exec("INSERT INTO $this->joinTable (Orders_id, Products_id, amount) VALUES ($order_id, $product, $qty);");
      }

      static::$db->commit();
    } 
    catch(Exception $e) {
      static::$db->rollback();
      echo "Erreur : ".$e->getMessage();
    }
    return true;

  }

  public function update($packed, $sent, $order_id) {
    $q = static::$db->prepare("UPDATE $this->tableName 
      SET packed=:packed, sent=:sent
      WHERE id=:id;");

    $a = array(
      'packed' => $packed,
      'sent' => $sent
      );

    if ($q->execute($a)) {
      header("Location: order.php?id=$id");
    }
    else {
      return false;
    }
  }
}



 ?>