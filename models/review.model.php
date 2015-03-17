<?php 
  require_once __DIR__."/../classes/model.class.php";
  require_once __DIR__."/../db.inc.php";
  require_once __DIR__."/../helpers.php";

  class Review extends Model {
    protected $tableName;
    protected static $db;

    public function Review($db) {
      $this->tableName = "Reviews";
      static::$db = $db;
    }

    public function create($name, $user_id, $product_id){
      $q = static::$db->prepare("INSERT INTO $this->tableName (stars, Users_id, Products_id) VALUES (:stars, :Users_id, :Products_id);");
      $q->bindParam(":stars", purify($stars));
      $q->bindParam(":Users_id", purify($user_id));
      $q->bindParam(":Products_id", purify($product_id));

      if ($q->execute()) {
        echo "insert successful"; //debug
      }
    }

    public function getByProduct($product_id){
      return $this->getBy("Products_id", $product_id);
    }

    public function getByUser($user_id){
      return $this->getBy("Users_id", $user_id);
    }
  }

?>