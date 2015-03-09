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
      $q->bindParam(":search", $search, PDO::PARAM_STRING);
      $q->execute();
      return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $description, $category_id, $price, $amount = 0){
      $q = static::$db->prepare("INSERT INTO $this->tableName (name, description, amount_available, price, Categories_id) VALUES (:name, :description, :amount, :price, :category_id);");
      $a = array(
        'name' => purify($name),
        'description' => purify($description),
        'category_id' => purify($category_id),
        'amount' => purify($amount),
        'price' => purify($price)
        );
      if ($q->execute($a)) {
        echo "insert successful"; //debug
      }
      else {
        echo "erreur lors de l'insertion d'un produit";
      }
    }

    public function update($name, $description, $category_id, $price, $amount, $id) {
      $q = static::$db->prepare("UPDATE $this->tableName 
        SET name=:name, description=:description, Categories_id=:category_id, price=:price, amount_available=:amount
        WHERE id=:id;");

      $a = array(
        'name' => purify($name),
        'description' => purify($description),
        'category_id' => purify($category_id),
        'amount' => purify($amount),
        'price' => purify($price),
        'id' => purify($id)
        );

      if ($q->execute($a)) {
        echo "update successful"; //debug
        //header("Location: product.php?id=$id");
      }
      else {
        echo "erreur lors de l'edit d'un produit";
      }
    }
  }

?>