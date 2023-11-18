<?php
session_start();
$user      = "root";
$password  = "";
$host      = "localhost";  
$database  = "si_uninassau";

try {
  $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo '<script>console.log("banco logado")</script>';
   } catch(PDOException $e) {
     echo "Conexão falhou: " . $e->getMessage();
  }

?>