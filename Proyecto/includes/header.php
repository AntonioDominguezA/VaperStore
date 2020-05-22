<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="includes/img/vape.png">

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script type="text/javascript" src="js/main.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/547cc69474.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
    </script>
    <title>VaperStore</title>
</head>
<body>
  <!--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <h2><a href="/Proyecto" style="text-decoration:none;color:white;text-align:center">INICIO</a></h2>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <?php if(!empty($user)): ?>
        <li class="nav-item active">
          <h3><a class="nav-link" href="venta.php">Ventas</a></h3>
        </li>
        <li class="nav-item active">
          <h3><a class="nav-link" href="inventory.php">Inventario</a></h3>
        </li>
          <?php if($user['username'] == "root"): ?>
            <li class="nav-item active">
              <h3><a class="nav-link" href="menu.php">Menu Administrador</a></h3>
            </li>
          <?php endif; ?>
        <li class="nav-item active">
          <h3><a class="nav-link" href="tickets.php">Tickets</a></h3>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>-->

  <?php if(!empty($user)): ?>
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fa fa-bars" id="btn"></i>
        <i class="fa fa-times" id="cancel"></i>
    </label>

      <div class="sidebar ">

          <header><a href="/Proyecto"><img src="includes/img/vape.PNG" class="img-rounded mt-3 mb-3" width="50%"></a></header>

          <ul id="hover">

              <li><a href="venta.php"><i class="fa fa-shopping-cart"></i>Ventas</a></li>
              <li><a href="inventory.php"><i class="fa fa-list"></i>Inventario</a></li>
              <?php if($user['tipo'] == "root" || $user['tipo'] == "Administrador"): ?>
              <li><a href="menu.php"><i class="fa fa-ticket"></i>Menu Administrador</a></li>
              <?php endif; ?>
              <li><a href="tickets.php"><i class="fa fa-user-circle"></i>Tickets</a></li>



          </ul>
          <div class="text-center" style="margin-top:50px">
            <a href="logout.php" type="button" class="btn btn-outline-danger btn-block" >Cerrar sesión</a>
          </div>
      </div>

  <?php endif; ?>

  <div class="navbar mt-5">

  </div>

    <section style="height: 10%">
