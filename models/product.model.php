<?php 
  require_once realpath("classes/model.class.php");
  require_once realpath("db.inc.php");
  require_once realpath("helpers.php");

  class Product extends Model {
    protected $tableName;
    protected static $db;

    public function Product($db) {
      $this->tableName = "Products";
      static::$db = $db;
    }

    public function search($search){
      $q = static::$db->prepare('SELECT * FROM '.$this->tableName.' WHERE name LIKE %:search%;');
      $q->bindParam(":search", $search, PDO::PARAM_INT);
      $q->execute();
      return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $description, $category_id, $price, $amount = 0){
      $q = static::$db->prepare("INSERT INTO $this->tableName (name, description, amount_available, price, category_id) VALUES (:name, :description, :amount, :price, :category_id);");
      $a = array(
        'name' => purify($name),
        'description' => purify($description),
        'category_id' => purify($category_id),
        'amount_available' => purify($amount),
        'price' => purify($price)
        );
      if ($q->execute($a)) {
        echo "insert successful"; //debug
      }
    }
  }

?>