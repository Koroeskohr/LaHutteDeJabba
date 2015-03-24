<?php
  require_once __DIR__."/../classes/model.class.php";
  require_once __DIR__."/../db.inc.php";
  require_once __DIR__."/../helpers.php";
  
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
      $check = static::$db->prepare("SELECT * FROM $this->tableName WHERE email=:email;");
      $check->bindParam("email", $email);
      if(!$check->fetch()){
        $q = static::$db->prepare("INSERT INTO $this->tableName (name, address, email, password, activated) VALUES (:name, :address, :email, :password, 0);");
        $a = array(
          'name' => purify($name),
          'address' => purify($address),
          'email' => purify($email),
          'password' => hash_passwd($password)
          );
        if ($q->execute($a)) {
          //sendActivationEmail($email, $name, static::$db->lastInsertId());
          return true;
        }
        else {
          return false;
        }
      }
      return false;
    }

    public function update($address, $name, $id) {
      $q = static::$db->prepare("UPDATE $this->tableName 
        SET address=:address, name=:name, password=:password
        WHERE id=:id;");

      $a = array(
        'name' => purify($name),
        'address' => purify($address),
        'id' => purify($id)
      );

      if ($q->execute($a)) {
        header("Location: user.php?id=$id");
      }
      else {
        return false;
      }
    }
    
    public function getNameById($id){
      $user = $this->getById($id);
      return $user["name"];
    }

    public function setActivated($id){
      $q = static::$db->prepare("UPDATE Users SET activated=1 WHERE id=:id");
      $q->bindParam("id",$id);

      $q->execute();
    }
  }

?>