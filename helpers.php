<?php 
  require_once "vendor/html_purifier/HTMLPurifier.auto.php";
  require_once "vendor/PHPMailer/PHPMailerAutoload.php";
  require_once 'db.inc.php';

  define("SALT", "Z3l1aQ0K");
  define("SECURE", FALSE);

  function hash_passwd($password){
    return hash("sha256", SALT.$password);
  }

  function purify($html) {
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    return $purifier->purify($html);
  }

  function sec_session_start() {
    $session_name = 'sec_session_id';
    $secure = SECURE;
    $httponly = true;
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    session_name($session_name);
    session_start(); 
    if(!isset($_SESSION["last_regen"])) $_SESSION["last_regen"] = 0;
    if ($_SESSION["last_regen"] + 10 < time()) {
      session_regenerate_id(true); 
      $_SESSION["last_regen"] = time();
    }     
  }

  function login($email, $password, $db) {
    if ($query = $db->prepare("SELECT id, name, email, password FROM Users WHERE email = :email LIMIT 1")) {
      $query->bindParam(':email', $email);
      $query->execute();
      $user = $query->fetch(PDO::FETCH_ASSOC);
      
      $password = hash_passwd($password);
      if ($query) {
        if ($user["password"] == $password) {
          $user_browser = $_SERVER['HTTP_USER_AGENT'];
          $user["id"] = preg_replace("/[^0-9]+/", "", $user["id"]);
          $_SESSION['user_id'] = $user["id"];
          $user["email"] = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user["email"]);
          $_SESSION['email'] = $user["email"];
          $_SESSION['name'] = $user["name"];
          $_SESSION["cart"] = [];
          $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
          $_SESSION['last_regen'] = time();
          return true;
        } else 
          return false;
        }
      } else {
      //User n'existe pas
      return false;
    }
  }
  

function login_check($db) {
  if (isset($_SESSION['user_id'], $_SESSION['name'], $_SESSION['login_string'], $_SESSION['email'])) {
    $user_id = $_SESSION['user_id'];
    $login_string = $_SESSION['login_string'];
    $username = $_SESSION['name'];
    
    $user_browser = $_SERVER['HTTP_USER_AGENT'];

    if ($query = $db->prepare("SELECT password FROM Users WHERE id = :id LIMIT 1")) {
      $query->bindParam(':id', $user_id);
      $query->execute(); 
      $result = $query->fetch(PDO::FETCH_ASSOC);

      if ($result) {
        $login_check = hash('sha512', $result["password"] . $user_browser);

        if ($login_check == $login_string) {
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  } else {
    return false;
  }
}

/* Ne fonctionne pas sur le netbook, pas de serveur de mail. Fonctionne depuis le serveur */
function sendActivationEmail($email, $name, $id){
  $key = hash("sha256", SALT.$name);
  mail($email, "activation", 'Hi ! Please activate your account ! http://imac_ecomm/activation.php?key='.$key.'&id='.$id);
}

?>