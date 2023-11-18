<?php
require('Config.php');

try {
 
  // sql to delete a record
  $id = $_GET['id'];


  $sql = "DELETE FROM provas WHERE id=". $id;

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Record deleted successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

header('Location: ../Tabela.php');

?>