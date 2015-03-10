<?php 
  require_once realpath("classes/model.class.php");
  require_once realpath("db.inc.php");
  require_once realpath("helpers.php");


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
      $q = static::$db->prepare("SELECT * FROM Reviews WHERE Products_id=:product_id;");
      $q->bindParam(":product_id", purify($product_id));

      if ($q->execute()) {
        echo "insert successful"; //debug
        return $q->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    }

    public function getByUser($user_id){
      $q = static::$db->prepare("SELECT * FROM Reviews WHERE Users_id=:user_id;");
      $q->bindParam(":user_id", purify($user_id));

      if ($q->execute()) {
        echo "insert successful"; //debug
        return $q->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    }
  }

?>