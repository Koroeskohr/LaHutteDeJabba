<?php 
  require_once "vendor/html_purifier/HTMLPurifier.auto.php";
  require_once 'db.inc.php';

  //salt utilisé pour la DB et la clé d'activation
  define("SALT", "Z3l1aQ0K");

  //permet de cacher le nom de session ou non à l'utilisateur
  define("SECURE", FALSE);

  /**
   * Hash un pass en sha256 avec un salt
   * @param  string $password Mot de passe
   * @return string           Hash produit
   */ 
  function hash_passwd($password){
    return hash("sha256", SALT.$password);
  }

  /**
   * Sert à purifier les input en bdd.
   * @param  string $html Chaine rentrée
   * @return string       Chaine purifiée
   */
  function purify($html) {
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config); //Utilise htmlspecialchars, stripslashes
    return $purifier->purify($html); 
  }


  /**
   * Crée une session avec cookies
   * @return void
   */
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

  /**
   * Vérifie les infos de login, crée la variable session
   * @param  string $email    Email(login)
   * @param  string $password Mot de passe non hashé
   * @param  PDO $db       Base de données
   * @return bool           Le login/password est correct et la variable session a été créée
   */
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
  
/**
 * Vérifie si les variables session sont présentes, donc si l'utilisateur est authentifié 
 * @param  PDO $db Base de données
 * @return bool     L'utilisateur est authentifié ou non
 */
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
/**
 * Envoie l'email d'activation
 * @param  string $email Email
 * @param  string $name  Nom du user
 * @param  int $id    ID en db du user
 * @return void
 */
function sendActivationEmail($email, $name, $id){
  $key = hash("sha256", SALT.$name);
  mail($email, "activation", 'Hi ! Please activate your account ! http://imac_ecomm/activation.php?key='.$key.'&id='.$id);
}

?>