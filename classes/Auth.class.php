<?php 
  require_once __DIR__."/../db.inc.php";
  require_once __DIR__.'/../helpers.php';

  class Auth {
    private $tableName = "Users";
    private $result;

    public function Auth(){

    }

    function validateLogin($user, $pass){
      $db->prepare('SELECT * FROM '.$this->tableName.' WHERE email = :user AND password = :pass');
      $db->bindParam(':user', purify($user));
      $db->bindParam(':pass', hash_passwd($pass));

      if($db->execute() && $this->result = $db->fetch(PDO::FETCH_ASSOC)){
        var_dump($result);
      } 

      /// TODO
    }

  }

 ?>