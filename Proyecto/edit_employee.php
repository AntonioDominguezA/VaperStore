<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['id_user'])) {
    $records = $conn->prepare('SELECT id_user,username,password,tipo FROM user WHERE id_user = :id');
    $records->bindParam(':id',$_SESSION['id_user']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0)
        $user = $results;
    }


  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $records = $conn->prepare("SELECT * FROM employee WHERE id_employee = '$id'");
    $records->execute();

    if($results = $records->fetch()) {
      $nombre = $results['name'];
      $apellido = $results['last_name'];
      $rfc = $results['RFC'];
      $tipo = $results['type_employee'];
      $escolaridad = $results['scholarship'];
      $direccion = $results['address'];
      $telefono = $results['phone'];
      $email = $results['email'];
    }
  }

  if (isset($_POST['save_employee'])) {
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido_empleado'];
    $rfc = $_POST['rfc'];
    $tipo = $_POST['tipo_empleado'];
    $escolaridad = $_POST['escolaridad'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['cell-phone'];
    $email = $_POST['email'];

    $consulta = "UPDATE employee SET name = '$nombre', last_name = '$apellido', RFC = '$rfc', type_employee = '$tipo', scholarship = '$escolaridad', address = '$direccion', phone = '$telefono', email = '$email' WHERE id_employee = '$id'";

    $stmt = $conn->prepare($consulta);

    if($stmt->execute()) {
      $message = 'Successfully';
    } else {
      $message = 'Sorry there must have been an issue';
    }

    header('Location: menu.php');
  }
 ?>

<?php require 'includes/header.php'; ?>

<div class="container-fluid" style="margin-top:20px">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Editar empleado</h5>
      <div class="container">
        <div class="rox">
          <div class="col-6 mx-auto">
            <div class="card card-body">
              <form action="edit_employee.php?id=<?php echo $_GET['id']?>" method="POST">
                <div class="form-group">
                  <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control" placeholder="Nombre del empleado" autofocus data-validation="alphanumeric" data-validation-allowing=" ">
                </div>
                <div class="form-group">
                  <input type="text" name="apellido_empleado" value="<?php echo $apellido; ?>" class="form-control" placeholder="Apellido del empleado" data-validation="alphanumeric" data-validation-allowing=" ">
                </div>
                <div class="form-group">
                    <input type="text" name="rfc" value="<?php echo $rfc; ?>" class="form-control" placeholder="RFC del empleado" data-validation="alphanumeric" data-validation-length="min13">
                </div>
                <div class="form-group">
                  <label for="type_employee">Tipo de empleado, Actual: <?php echo $tipo; ?> </label>
                  <select class="form-control" name="tipo_empleado" id="type_employee" value="<?php echo $tipo; ?>" data-validation="required">
                    <option><?php echo $tipo; ?></option>
                    <option>Cajero</option>
                    <option>Soporte</option>
                    <option>Vendedor</option>
                    <option>Gerente</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" name="escolaridad" value="<?php echo $escolaridad; ?>" class="form-control" placeholder="Escolaridad" data-validation="alphanumeric">
                </div>
                <div class="form-group">
                  <input type="text" name="direccion" value="<?php echo $direccion; ?>" class="form-control" placeholder="Direccion del empleado" data-validation="alphanumeric" data-validation-allowing=" ">
                </div>
                <div class="form-group">
                  <input type="text" name="cell-phone" value="<?php echo $telefono; ?>" class="form-control" placeholder="Telefono del empleado" data-validation="number">
                </div>
                <div class="form-group">
                  <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Email del empleado" data-validation="email">
                </div>
                <button type="submit" name="save_employee" class="btn btn-success btn-block">Editar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<?php require 'includes/footer.php'; ?>
