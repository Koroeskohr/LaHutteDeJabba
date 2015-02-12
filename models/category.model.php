<?php 
  require_once realpath("classes/model.class.php");
  require_once realpath("db.inc.php");

  class Category extends Model {
    private $tableName;
    protected $db;

    public function Category($db) {
      $this->tableName = "Categories";
      $this->db = $db;
    }

    public function all(){
      return $this->db->query("SELECT * FROM ".$this->tableName);
    }

    public function getById($id) {
      $q = $this->db->prepare("SELECT * FROM ".$this->tableName." WHERE id=:id");
      $q->bindParam(":id", $id, PDO::PARAM_INT);
      $q->execute();
      return $q->fetch()[1];
    }
  }

?>