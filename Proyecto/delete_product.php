<?php
  require 'conexion.php';

  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $consulta = "DELETE FROM product WHERE id_producto = $id";
    $stmt = $conn->prepare($consulta);

    if($stmt->execute()) {
      $message = 'Successfully';
    } else {
      $message = 'Sorry there must have been an issue';
    }

    header('Location: menu.php');
  }
 ?>
