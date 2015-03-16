<?php
require 'variables.php';

/*
define DB_IP, DB_NAME, DB_USER, DB_PASS
 */

try {
    $db = new PDO("mysql:host=".DB_IP.";dbname=".DB_NAME.";", DB_USER, DB_PASS);
} 
catch (PDOException $e) {
    print "Database error : " . $e->getMessage() . "<br/>";
    die();
}
?>