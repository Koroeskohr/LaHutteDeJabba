<?php 
  require_once __DIR__."/../classes/model.class.php";
  require_once __DIR__."/../models/user.model.php";
  require_once __DIR__."/../db.inc.php";
  require_once __DIR__."/../helpers.php";

  class Review extends Model {
    protected $tableName;
    protected static $db;
    protected $users;

    public function Review($db) {
      $this->tableName = "Reviews";
      static::$db = $db;
      $users = new User($db);
    }

    public function create($stars, $commentary, $user_id, $product_id){
      $q = static::$db->prepare("INSERT INTO $this->tableName (stars, Users_id, Products_id, commentary) VALUES (:stars, :Users_id, :Products_id, :commentary);");
      $q->bindParam(":stars", purify($stars));
      $q->bindParam(":Users_id", purify($user_id));
      $q->bindParam(":Products_id", purify($product_id));
      $q->bindParam(":commentary", purify($commentary));

      if ($q->execute()) {
        return true;
      }
      else {
        return false;
      }
    }

    public function getByProduct($product_id){
      $q = static::$db->prepare("SELECT Reviews.id, Reviews.stars, Reviews.commentary, Reviews.Users_id, Users.name 
        FROM $this->tableName , Users
        WHERE Reviews.Products_id=:id 
        AND Reviews.Users_id=Users.id;");
      $q->bindParam(":id", $product_id);
      $q->execute();

      return $q->fetchAll(PDO::FETCH_ASSOC);  
    }

    public function getByUser($user_id){
      return $this->getBy("Users_id", $user_id);
    }

    public function hasUserCommented($product_id, $user_id){
      $q = static::$db->prepare("SELECT id 
                                FROM $this->tableName
                                WHERE Products_id=:productId 
                                AND Users_id=:userId;");

      $q->bindParam(":productId", $product_id);
      $q->bindParam(":userId", $user_id);
      $q->execute();

      return $q->fetch(PDO::FETCH_ASSOC); 
    }
  }

?>