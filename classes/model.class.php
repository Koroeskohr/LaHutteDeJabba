<?php 
  require_once __DIR__."/../db.inc.php";
  require_once __DIR__.'/../helpers.php';

  abstract class Model {

    protected $tableName = null;
    protected static $db;

    public function all() {
      return static::$db->query("SELECT * FROM ".$this->tableName, PDO::FETCH_ASSOC);
    }

    public function getById($id) {
      $q = static::$db->prepare("SELECT * FROM $this->tableName WHERE id=:id;");
      $q->bindParam(":id", purify($id), PDO::PARAM_INT);
      
      if ($q->execute()) return $q->fetch(PDO::FETCH_ASSOC);
      else return false;
    }

    public function getBy($columnName, $arg){
      if ($columnName == "id") return $this->getById($arg);
      $q = static::$db->prepare("SELECT * FROM $this->tableName WHERE $columnName=:arg;");
      $q->bindParam(":arg", purify($arg));
      if($q->execute()) return $q->fetchAll(PDO::FETCH_ASSOC);
      else return false;
    }

    public function destroy($id){
      $q = static::$db->prepare("DELETE FROM $this->tableName WHERE id=:id");
      $q->bindParam(":id", purify($id));
      if($q->execute()) return true;
      else return false;
    }
  }

?>