<?php 
  require_once realpath("classes/model.class.php");
  require_once realpath("db.inc.php");

  class Category extends Model {
    protected $tableName;
    protected static $db;

    public function Category($db) {
      $this->tableName = "Categories";
      static::$db = $db;
    }

    public function getProducts($id) {
      $q = static::$db->prepare('SELECT * FROM '.$this->tableName.' WHERE category_id=:id;');
      $q->bindParam(":id", $id, PDO::PARAM_INT);
      $q->execute();
      return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name){
      $q = static::$db->prepare("INSERT INTO $this->tableName (name) VALUES (:name);");
      $q->bindParam(":name", $name);
      if ($q->execute()) {
        echo "insert successful"; //debug
      }
    }
  }

?>