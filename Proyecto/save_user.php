<?php

  require 'conexion.php';

  if(isset($_POST['save_user'])) {
    $nombre = $_POST['nombre_usuario'];
    $id_empleado = $_POST['id_empleado'];
    $password = $_POST['pass_confirmation'];
    $tipo = $_POST['tipo_usuario'];

    $messageOne = "";
    $records = $conn->prepare("SELECT id_employee FROM employee WHERE id_employee = '$id_empleado'");
    $records->execute();
    $results = $records->fetch();

    $id_validate = $results['id_employee'];

    if($id_empleado == $id_validate) {
      $consulta = "INSERT INTO user (id_empleado,username,password,tipo) VALUES ('$id_empleado', '$nombre', '$password', '$tipo')";
      $stmt = $conn->prepare($consulta);
      if($stmt->execute()) {
        $messageOne = 'Successfully created new user';
      } else {
        $messageOne = 'Sorry there must have been an issue creating your user';
      }

    } else {
      $messageOne = 'Sorry the employee does not exist';
    }
    header('Location: menu.php');
  }

 ?>
