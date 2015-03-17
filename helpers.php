<?php 
  require_once "vendor/html_purifier/HTMLPurifier.auto.php";
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
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id(true);    // regenerated the session, delete the old one. 
  }

  function login($email, $password, $db) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($dbResult = $db->prepare("SELECT id, email, password FROM Users WHERE email = :email LIMIT 1")) {
      $dbResult->bindParam(':email', $email);  // Bind "$email" to parameter.
      $dbResult->execute();    // Execute the prepared query.

      // get variables from result.
      $user = $dbResult->fetch(PDO::FETCH_ASSOC);
      // hash the password with the unique salt.
      
      $password = hash_passwd($password);
      if ($dbResult) {
        // If the user exists we check if the account is locked
        // from too many login attempts 
        // Check if the password in the database matches
        // the password the user submitted.
        if ($user["password"] == $password) {
          // Password is correct!
          // Get the user-agent string of the user.
          $user_browser = $_SERVER['HTTP_USER_AGENT'];
          // XSS protection as we might print this value
          $user["id"] = preg_replace("/[^0-9]+/", "", $user["id"]);
          $_SESSION['user_id'] = $user["id"];
          // XSS protection as we might print this value
          $user["email"] = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user["email"]);
          $_SESSION['username'] = $user["email"];
          $_SESSION['login_string'] = hash('sha256', $password . $user_browser);
          // Login successful.
          return true;
        } else 
          return false;
        }

      } else {
      // No user exists.
      return false;
    }
  }
  



function login_check($db) {
  // Check if all session variables are set 
  if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
 
    $user_id = $_SESSION['user_id'];
    $login_string = $_SESSION['login_string'];
    $username = $_SESSION['username'];

    // Get the user-agent string of the user.
    $user_browser = $_SERVER['HTTP_USER_AGENT'];

    if ($stmt = $db->prepare("SELECT password FROM Users WHERE id = :id LIMIT 1")) {
      // Bind "$user_id" to parameter. 
      $stmt->bindParam(':id', $user_id);
      $stmt->execute();   // Execute the prepared query.
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result) {
        // If the user exists get variables from result.
        $login_check = hash('sha512', $password . $user_browser);

        if ($login_check == $login_string) {
          // Logged In!!!! 
          return true;
        } else {
          // Not logged in 
          return false;
        }
      } else {
        // Not logged in 
        return false;
      }
    } else {
      // Not logged in 
      return false;
    }
  } else {
    // Not logged in 
    return false;
  }
}



function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
    $url = str_replace(';//', '://', $url);
    $url = htmlentities($url);
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

?>