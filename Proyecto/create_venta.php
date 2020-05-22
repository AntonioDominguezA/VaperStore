<?php
  require 'conexion.php';

  if(isset($_POST['save_venta'])) {
    $id_producto = $_POST['id_producto'];

    $message2 = '';

    $records = $conn->prepare("SELECT id_producto,name,price,quantity FROM product WHERE id_producto = '$id_producto'");
    $records->execute();
    $results = $records->fetch();

    $cantidad = $results['quantity'];

    if($cantidad > 0) {
      $id_validate = $results['id_producto'];
      $nombre = $results['name'];
      $precio = $results['price'];

      if($id_validate == $id_producto) {
        $consulta = "INSERT INTO venta (id_producto,nombre,precio) VALUES ('$id_producto','$nombre','$precio')";
        $stmt = $conn->prepare($consulta);

        if($stmt->execute()) {
          $message2 = 'Successfully created';
        } else {
          $message2 = 'Sorry there must have been an issue creating your sell';
        }
      } else {
        $message2 = 'Sorry the product does not exist';
      }
    } else {
      $message2 = 'Sorry the product is out of stock';
    }

    header('Location: venta.php');
  }

 ?>
