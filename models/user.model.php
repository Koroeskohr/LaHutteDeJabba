<?php
  require_once realpath("classes/model.class.php");
  require_once realpath("db.inc.php");

  class User extends Model {
    protected $tableName;
    protected static $db;

    public function User($db) {
      $this->tableName = "Users";
      static::$db = $db;
    }

    /* Sera utilisé pour la recherche */
    public function getByName($name) { 
      return $this->getBy("name", $name)[0];
    }


  }

?>