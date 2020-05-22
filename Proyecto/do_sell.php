<?php
  require 'conexion.php';

  // id empleado
  $id_empleado = $_GET['id'];
  $precio = $_GET['total'];

  $timezone  = -6;

  $fecha = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));

  // descripcion

  $records = $conn->prepare("SELECT * FROM venta");
  $records->execute();

  $descripcion = "";

  // Resto la cantidad de producto vendida
  while($row = $records->fetch()) {
    $id_product = $row['id_producto'];
    $nombre = $row['nombre'];
    $price = $row['precio'];

    $records2 = $conn->prepare("UPDATE product SET quantity = quantity - 1 WHERE id_producto = '$id_product'");
    $records2->execute();

    $descripcion .= "Producto: $nombre, Precio: $$price"."\n";
  }

  // Inserto datos en la tabla ticket

  $stmt2 = $conn->prepare("INSERT INTO ticket (id_empleado,total,fecha,descripcion) VALUES ('$id_empleado','$precio','$fecha','$descripcion')");

  if($stmt2->execute()) {
    $query = "TRUNCATE TABLE venta";

    $stmt = $conn->prepare($query);

    if($stmt->execute()) {
      $message = 'Successfully';
    } else {
      $message = 'Sorry there must have been an issue';
    }
  }
  header('Location: venta.php');
 ?>
