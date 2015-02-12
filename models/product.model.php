<?php 
  require_once realpath("classes/model.class.php");
  require_once realpath("db.inc.php");

  class Product extends Model {
    private $tableName;
    protected $db;

    public function Product($db) {
      $this->tableName = "Products";
      $this->db = $db;
    }

    public function all(){
      return $this->db->query("SELECT * FROM ".$this->tableName);
    }

    public function getById($id) {
      $q = $this->db->prepare("SELECT * FROM ".$this->tableName."' WHERE id=:id;");
      $q->bindParam(":id", $id, PDO::PARAM_INT);
      $q->execute();
      return $q->fetch()[1];
    }

    public function getByCategory($id) {
      $q = $this->db->prepare('SELECT * FROM '.$this->tableName.' WHERE category_id=:id;');
      $q->bindParam(":id", $id, PDO::PARAM_INT);
      $q->execute();
      return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($search){
      $q = $this->db->prepare('SELECT * FROM '.$this->tableName.' WHERE name LIKE %:search%;');
      $q->bindParam(":search", $search, PDO::PARAM_INT);
      $q->execute();
      return $q->fetchAll(PDO::FETCH_ASSOC);
    }
  }

?>