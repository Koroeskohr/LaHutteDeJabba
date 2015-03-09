<?php 
  require_once realpath("vendor/html_purifier/HTMLPurifier.auto.php");

  define("SALT", "Z3l1aQ0K");

  function hash_passwd($password){
    return hash("sha256", SALT.$password);
  }

  function purify($html) {
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    echo "$html\n".$purifier->purify($html);

    return $purifier->purify($html);
    

  }

?>