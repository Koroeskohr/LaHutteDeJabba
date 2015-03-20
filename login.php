<?php 
require_once 'helpers.php';
require_once 'db.inc.php';

 
sec_session_start(); 
 
if (isset($_POST['email'], $_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password']; 

  if (login($email, $password, $db) == true) {
    header('Location: ../index.php');
  } else {
    echo "Login failed<br />";
    echo "<a href='index.php'>Retour a l'accueil</a>";
  }
} else {
  echo 'Invalid Request';
}

?>