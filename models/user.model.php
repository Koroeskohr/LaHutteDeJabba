<?php
  require_once realpath("classes/model.class.php");
  require_once realpath("db.inc.php");
  require_once realpath("helpers.php");

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

    public function create($name, $address, $email, $password){
      $q = static::$db->prepare("INSERT INTO $this->tableName (name, address, email, password) VALUES (:name, :address, :email, :password);");
      $a = array(
        'name' => $name,
        'address' => $address,
        'email' => $email,
        'password' => hash_passwd($password)
        );
      if ($q->execute($a)) {
        echo "insert successful"; //debug
      }
    }
  }

?>