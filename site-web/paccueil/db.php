<?php


try {
  $conn = new PDO("mysql:host=localhost;dbname=bad_event", 'root', '');
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "connexion réussie";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

    

?>
