<?php
require 'variables.php';


try {
    $db = new PDO("mysql:host=".DB_IP.";dbname=".DB_NAME.";", DB_USER, DB_PASS);
} 
catch (PDOException $e) {
    print "Database error : " . $e->getMessage() . "<br/>";
    die();
}
?>