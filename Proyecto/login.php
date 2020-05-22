<?php
  session_start();

  require 'conexion.php';

  $message = "";

  if(!empty($_POST['user']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id_user, id_empleado, username, password, tipo FROM user WHERE username = :user');
    $records->bindParam(':user',$_POST['user']);
    $records->execute();

    $message = "";

    $results = $records->fetch(PDO::FETCH_ASSOC);

    $p1 = $_POST['password'];
    $p2 = $results['password'];
    if ( $p1 == $p2) {
      $_SESSION['id_user'] = $results['id_user'];
      header('Location: /Proyecto');
    } else {
      $message = "Sorry, those credentials do not match";
    }

  }
 ?>

<?php require 'includes/header.php'; ?>
    <br>

    <img src="includes/img/logo.PNG" class="rounded mx-auto d-block" alt="Vaper" style="width: 10%;height:20%">

    <div class="container p-4 text-center">
      <h1>Inicia sesión con tu cuenta</h1>
      <div class="container p-4">
        <?php if(!empty($message)):  $message = ""?>
        <div class="alert alert-warning">
          <strong>Warning!</strong> Alguna de las credenciales no es correcta
        </div>
        <?php endif; ?>
        <div class="card card-body" style="width:40%;height:40%;display:inline-block">
          <form action="login.php" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="user" placeholder="Ingresar Usuario" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Ingresa contraseña" required>
            </div>
              <input type="submit" class="btn btn-success btn-block" value="Ingresar">
          </form>
        </div>
      </div>
    </div>

</body>
</html>
