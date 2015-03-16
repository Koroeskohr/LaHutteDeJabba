<?php 
  require_once __DIR__."/../classes/model.class.php";
  require_once __DIR__."/../db.inc.php";
  require_once __DIR__."/../helpers.php";

  class Category extends Model {
    protected $tableName;
    protected static $db;

    public function Category($db) {
      $this->tableName = "Categories";
      static::$db = $db;
    }

    public function getProducts($id) {
      $q = static::$db->prepare("SELECT * FROM Products WHERE Categories_id=:id;");
      $q->bindParam(":id", $id, PDO::PARAM_INT);
      $q->execute();
      return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name){
      $q = static::$db->prepare("INSERT INTO $this->tableName (name) VALUES (:name);");
      $q->bindParam(":name", purify($name));
      if ($q->execute()) {
        echo "insert successful"; //debug
      }
    }

    public function update($name, $id) {
      $q = static::$db->prepare("UPDATE $this->tableName 
        SET name=:name
        WHERE id=:id;");

      $a = array(
        'name' => purify($name),
        'id' => purify($id)
        );

      if ($q->execute($a)) {
        echo "update successful"; //debug
        header("Location: product.php?id=$id");
      }
      else {
        echo "erreur lors de l'edit d'une catégorie";
      }
    }
  }

?>