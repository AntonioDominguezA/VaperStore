<?php
  require 'conexion.php';

  if(isset($_POST['save_provider'])) {
    $nombre = $_POST['nombre_proveedor'];
    $rfc = $_POST['rfc'];
    $telefono = $_POST['cell-phone'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];

    $consulta = "INSERT INTO provider (name,RFC,phone,address,email) VALUES ('$nombre','$rfc','$telefono','$direccion','$email')";
    $stmt = $conn->prepare($consulta);

    if($stmt->execute()) {
      $message = 'Successfully created new employee';
    } else {
      $message = 'Sorry there must have been an issue creating your employee';
    }

    header('Location: menu.php');
  }

 ?>
