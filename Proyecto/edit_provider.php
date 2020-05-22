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

    $records = $conn->prepare("SELECT * FROM provider WHERE id_provider = '$id'");
    $records->execute();

    if($results = $records->fetch()) {
      $nombre = $results['name'];
      $rfc = $results['RFC'];
      $telefono = $results['phone'];
      $direccion = $results['address'];
      $email = $results['email'];
    }
  }

  if (isset($_POST['save_provider'])) {
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $rfc = $_POST['rfc'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];

    $consulta = "UPDATE provider SET name = '$nombre', RFC = '$rfc', phone = '$telefono', address = '$direccion', email = '$email' WHERE id_provider = '$id'";

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
      <h5 class="card-title">Editar proveedor</h5>
      <div class="container">
        <div class="row">
          <div class="col-6 mx-auto">
            <div class="card card-body">
              <form action="edit_provider.php?id=<?php echo $_GET['id']?>" method="POST">
                <div class="form-group">
                  <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control" placeholder="Nombre del proveedor" autofocus data-validation="alphanumeric" data-validation-allowing=" ">
                </div>
                <div class="form-group">
                  <input type="text" name="rfc" value="<?php echo $rfc; ?>" class="form-control" placeholder="RFC" data-validation="alphanumeric" data-validation-length="min13">
                </div>
                <div class="form-group">
                    <input type="text" name="telefono" value="<?php echo $telefono; ?>" class="form-control" placeholder="Telefono" data-validation="number">
                </div>
                <div class="form-group">
                  <input type="text" name="direccion" value="<?php echo $direccion; ?>" class="form-control" placeholder="Direccion" data-validation="alphanumeric" data-validation-allowing=" ">
                </div>
                <div class="form-group">
                  <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Email" data-validation="email">
                </div>
                <button type="submit" name="save_provider" class="btn btn-success btn-block">Editar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<?php require 'includes/footer.php'; ?>
