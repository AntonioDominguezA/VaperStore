<?php
    require 'conexion.php';

    $message = "";

    $user = $_POST['user'];
    $pass = $_POST['password'];
    $empl = $_POST['empleado'];
    $tip = $_POST['tipo'];
    //consulta mysql para insertar los datos del empleados
    $consulta = "INSERT INTO user (id_empleado,username,password,tipo) VALUES ('$empl', '$user', '$pass', '$tip')";
    $stmt = $conn->prepare($consulta);

    if($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your user';
    }
?>
