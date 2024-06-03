<?php
$servername = "localhost";
$username = "root";
$database = "somacrm_test";

// Create connection
try {
  $pdo = new PDO("mysql:host=$servername;dbname=$database", $username);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>