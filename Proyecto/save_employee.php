<?php

  require 'conexion.php';

  if(isset($_POST['save_employee'])) {
    $nombre = $_POST['nombre_empleado'];
    $apellido = $_POST['apellido_empleado'];
    $rfc = $_POST['rfc'];
    $tipo = $_POST['tipo_empleado'];
    $escolaridad = $_POST['escolaridad'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['cell-phone'];
    $email = $_POST['email'];

    $consulta = "INSERT INTO employee (name,last_name,RFC,type_employee,scholarship,address,phone,email) VALUES ('$nombre', '$apellido', '$rfc', '$tipo','$escolaridad','$direccion','$telefono','$email')";
    $stmt = $conn->prepare($consulta);

    if($stmt->execute()) {
      $message = 'Successfully created new employee';
    } else {
      $message = 'Sorry there must have been an issue creating your employee';
    }

    header('Location: menu.php');
  }

 ?>
