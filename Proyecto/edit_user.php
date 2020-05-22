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

    $records = $conn->prepare("SELECT * FROM user WHERE id_user = '$id'");
    $records->execute();

    if($results = $records->fetch()) {
      $id_empleado = $results['id_empleado'];
      $nombre = $results['username'];
      $password = $results['password'];
      $tipo = $results['tipo'];
    }
  }

  if (isset($_POST['save_user'])) {
    $id = $_GET['id'];
    $id_empleado = $_POST['id_empleado'];
    $nombre = $_POST['username'];
    $password = $_POST['pass_confirmation'];
    $tipo = $_POST['tipo'];

    $message = "";

    $records = $conn->prepare("SELECT id_employee FROM employee WHERE id_employee = '$id_empleado'");
    $records->execute();
    $results = $records->fetch();

    $id_validate = $results['id_employee'];

    if($id_empleado == $id_validate) {
      $consulta = "UPDATE user SET id_empleado = '$id_empleado', username = '$nombre', password = '$password', tipo = '$tipo' WHERE id_user = '$id'";

      $stmt = $conn->prepare($consulta);

      if($stmt->execute()) {
        $message = 'Successfully';
        header('Location: menu.php');
      } else {
        $message = 'Sorry there must have been an issue';
      }
    } else {
      $message = 'Sorry the employee does not exist';
    }


  }
 ?>

<?php require 'includes/header.php'; ?>

<div class="container-fluid" style="margin-top:20px">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Editar usuario</h5>
      <div class="container">
        <div class="row">
          <div class="col-6 mx-auto">
            <div class="card card-body">
              <form action="edit_user.php?id=<?php echo $_GET['id']?>" method="POST">
                <div class="form-group">
                  <input type="text" name="id_empleado" value="<?php echo $id_empleado; ?>" class="form-control" placeholder="ID empleado" data-validation="number">
                </div>
                <div class="form-group">
                  <input type="text" name="username" value="<?php echo $nombre; ?>" class="form-control" placeholder="Nombre de usuario" data-validation="alphanumeric" data-validation-allowing="-_">
                </div>
                <div class="form-group">
                    <input type="password" name="pass_confirmation" value="<?php echo $password; ?>" class="form-control" placeholder="Contraseña" data-validation="length" data-validation-length="min8">
                </div>
                <div class="form-group">
                  <input type="password" name="pass" value="<?php echo $password; ?>" class="form-control" placeholder="Verificar contraseña" data-validation="confirmation">
                </div>
                <div class="form-group">
                  <label for="type_user">Tipo de usuario</label>
                  <select class="form-control" name="tipo" id="type_user" data-validation="required">
                    <option><?php echo $tipo; ?></option>
                    <option>root</option>
                    <option>normal</option>
                  </select>
                </div>
                <button type="submit" name="save_user" class="btn btn-success btn-block">Editar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>




<?php require 'includes/footer.php'; ?>
