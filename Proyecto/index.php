<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['id_user'])) {
    $records = $conn->prepare('SELECT id_user,username,password,tipo FROM user WHERE id_user = :id');
    $records->bindParam(':id',$_SESSION['id_user']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
  }
 ?>

<?php require 'includes/header.php'; ?>
<br>
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <br>
        <img src="includes/img/logo.PNG" class="rounded mx-auto d-block" alt="Vaper" style="width: 10%;height:20%">

        <?php if(!empty($user)): ?>
        <div class="container text-center">
          <br><h3>Bienvenido <?= $user['username'] ?></h3>
          <br>
          <a href="logout.php">Logout</a>

        </div>
        <?php else: ?>
          <div class="container text-center">
            <h1>Please Login</h1>

            <a href="login.php">Login</a>
          </div>

        <?php endif; ?>
      </div>
    </div>
  </div>


<?php require 'includes/footer.php'; ?>
