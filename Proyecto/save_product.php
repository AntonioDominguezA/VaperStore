<?php

  require 'conexion.php';

  if(isset($_POST['save_product'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $id_proveedor = $_POST['id_proveedor'];
    $foto = $_FILES['foto'];

    $ruta = 'includes/img/'.$foto['name'];

    $message = "";

    $records = $conn->prepare("SELECT id_provider FROM provider WHERE id_provider = '$id_proveedor'");
    $records->execute();
    $results = $records->fetch();

    $id_validate = $results['id_provider'];

    if($id_proveedor == $id_validate) {
      $consulta = "INSERT INTO product (name,price,quantity,picture,id_provider) VALUES ('$nombre', '$precio', '$cantidad', '$ruta', '$id_proveedor')";
      $stmt = $conn->prepare($consulta);

      if($stmt->execute()) {
        $message = 'Successfully created new employee';
      } else {
        $message = 'Sorry there must have been an issue creating your employee';
      }
    } else {
      $message = 'Sorry the provider does not exist';
    }
    header('Location: menu.php');
  }

 ?>
