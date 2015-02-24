<?php 
  require_once realpath("db.inc.php");

  abstract class Model {

    protected $tableName = null;
    protected static $db;

    public function all() {
      return static::$db->query("SELECT * FROM ".$this->tableName, PDO::FETCH_ASSOC);
    }

    public function getById($id) {
      $q = static::$db->prepare("SELECT * FROM $this->tableName WHERE id=:id;");
      $q->bindParam(":id", $id, PDO::PARAM_INT);
      $q->execute();
      return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function getBy($columnName, $arg){
      if ($columnName == "id") return $this->getById($arg);
      $q = static::$db->prepare("SELECT * FROM $this->tableName WHERE $columnName=:arg;");
      $q->bindParam(":arg", $arg);
      $q->execute();
      return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    abstract function create();
    abstract function update();
  }

?>