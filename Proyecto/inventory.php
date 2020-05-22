<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['id_user'])) {
    $records = $conn->prepare('SELECT id_user,id_empleado,username,password,tipo FROM user WHERE id_user = :id');
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

  <?php if(!empty($user)): ?>
  <div class="container-fluid mt-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Inventario</h5>
        <div class="container bg-light">
          <div class="card-columns text-center">
            <?php
                $records = $conn->prepare("SELECT product.*, provider.id_provider as id_p, provider.name as namep FROM product, provider WHERE product.id_provider = provider.id_provider");
                $records->execute();

                while ($row = $records->fetch()) { ?>
                <div class="card" style="width: 18rem;">
                  <img src="<?php echo $row['picture']; ?>" class="card-img-top" alt="">
                  <div class="card-body">
                    <b><h5 class="card-title"><?php echo $row['name']; ?></h5></b>
                    <p>ID: <?php echo $row['id_producto']; ?></p>
                    <p class="card-text">Precio: $<?php echo $row['price']; ?></p>
                    <p class="card-text">Cantidad: <?php echo $row['quantity']; ?></p>
                    <p class="card-text">Proveedor: <?php echo $row['namep']; ?></p>
                  </div>
                </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
    <hr>



  <?php else: ?>
    header("Location: /Proyecto");
  <?php endif; ?>

<?php require 'includes/footer.php'; ?>
